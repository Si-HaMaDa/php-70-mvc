<?php

namespace App\Controllers;

use App\Models\Skill;
use App\Models\User;
use App\Traits\Pagination;
use App\Validations\Validations;

class UserController
{
    use Pagination;

    public function index()
    {

        extract(
            $this->paginate(
                (new User())->count()
            )
        );

        $users = (new User())->all('*', [$start, $per_page]);

        $title = 'Users';

        require get_view_dir('users/index');
        // get_view('users/index', [
        //     'users' => $users,
        //     'title' => $title,
        // ]);
    }

    public function create()
    {
        $title = 'Add User';

        $skills = (new Skill())->all('id, name');

        require get_view_dir('users/create');
        // get_view('users/create', [
        //     'title' => $title,
        // ]);
    }

    public function store()
    {
        $validated = [
            'name' => (new Validations($_POST['name']))
                ->notEmpty()
                ->isName(),

            'email' => (new Validations($_POST['email']))
                ->notEmpty()
                ->isEmail(),

            'password' => (new Validations($_POST['password']))
                ->notEmpty()
                ->min(6)
                ->max(30)
                ->confirmed($_POST['password_confirmation']),

            'role' => (new Validations($_POST['role']))
                ->notEmpty()
                ->isIn(['user', 'admin']),

            'gender' => (new Validations($_POST['gender']))
                ->notEmpty()
                ->isIn(['m', 'f']),

            'age' => (new Validations($_POST['age']))
                ->notEmpty()
                ->isInteger(),

            'title' => (new Validations($_POST['title']))
                ->notEmpty()
                ->isName(),

            'image' => (new Validations($_FILES['image']))
                ->isFile()
                ->fileSize(600)
                ->isImage()
                ->extensionIn(['jpg', 'png', 'jpeg'])
                ->isNullable(),
        ];

        $user = check_validation_and_get_data($validated);

        $user['password'] = sha1($user['password']);

        if ($user['image']) $user['image'] = User::upload_image($user['image']);
        else unset($user['image']);

        (new User())->insert($user);

        $user_id = (new User())->connection->lastInsertId();


        (new User())->save_skills($user_id, $_POST['skills']);

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User added successfully.']
        );
    }

    public function show()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->find($id);

        if (!$user)
            redirect_with_msgs(make_url('/admin/users'), ['error' => 'User not found.']);

        $user['skills'] = (new User())->get_skills($id);

        $title = 'Show User';

        require get_view_dir('users/show');
        // get_view('users/show', [
        //     'user' => $user,
        //     'title' => $title,
        // ]);
    }

    public function edit()
    {
        $id = (int)$_GET['id'];

        $user = (new User())->find($id);

        if (!$user)
            redirect_with_msgs(make_url('/admin/users'), ['error' => 'User not found.']);

        $skill_ids = array_map(function ($arr) {
            return $arr['id'];
        }, (new User())->get_skills($id));

        // foreach ((new User())->get_skills($id) as $skill) $skill_ids[] = $skill['id']

        $user['skills'] = ((array) get_old_value('skills', false) ?: $skill_ids);

        $skills = (new Skill())->all('id, name');

        // var_dump($user['skills']);
        // die;

        $title = 'Edit User';

        require get_view_dir('users/edit');
        // get_view('users/create', [
        //     'title' => $title,
        // ]);
    }

    public function update()
    {
        $id = (int)$_GET['id'];

        $validated = [
            'name' => (new Validations($_POST['name']))
                ->notEmpty()
                ->isName(),

            'email' => (new Validations($_POST['email']))
                ->notEmpty()
                ->isEmail(),

            'role' => (new Validations($_POST['role']))
                ->notEmpty()
                ->isIn(['user', 'admin']),

            'gender' => (new Validations($_POST['gender']))
                ->notEmpty()
                ->isIn(['m', 'f']),

            'age' => (new Validations($_POST['age']))
                ->notEmpty()
                ->isInteger(),

            'title' => (new Validations($_POST['title']))
                ->notEmpty()
                ->isName(),

            'image' => (new Validations($_FILES['image']))
                ->isFile()
                ->fileSize(600)
                ->isImage()
                ->extensionIn(['jpg', 'png', 'jpeg'])
                ->isNullable(),
        ];

        if ($_POST['password']) {
            $validated['password'] = (new Validations($_POST['password']))
                ->notEmpty()
                ->min(6)
                ->max(30)
                ->confirmed($_POST['password_confirmation']);
        }

        $user = check_validation_and_get_data($validated);

        $user['password'] = sha1($user['password']);

        if ($user['image']) $user['image'] = User::upload_image($user['image'], $id);
        else unset($user['image']);

        (new User())->update($user, ['id' => $id]);

        (new User())->save_skills($id, $_POST['skills']);

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User updated successfully.']
        );
    }


    public function delete()
    {
        $ids =
            isset($_POST['id']) && is_array($_POST['id']) // if multiple ids are selected
            ? (array) $_POST['id'] // convert to array if not
            : [(int) $_REQUEST['id']]; // else make it an array with one id

        foreach ($ids as $id) { // loop through each id and delete
            $id = (int)$id;
            (new User())->delete($id);
        }

        redirect_with_msgs(
            make_url('/admin/users'),
            ['success' => 'User deleted successfully.']
        );
    }

    public function users_api()
    {
        $users = (new User())->all();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($users);
    }
}
