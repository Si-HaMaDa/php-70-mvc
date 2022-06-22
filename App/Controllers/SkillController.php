<?php

namespace App\Controllers;

use App\Models\Skill;
use App\Validations\Validations;

class SkillController
{
    public function index()
    {
        $page = isset($_GET['page']) ? (abs((int) $_GET['page']) ?: 1) : 1;

        $per_page = 10;

        $start = ($page - 1) * $per_page;

        $count = (new Skill())->count();

        $total_pages = ceil($count / $per_page);

        $next_page = ($page + 1) > $total_pages ? $total_pages : ($page + 1);

        $skills = (new Skill())->all('*', [$start, $per_page]);

        $title = 'Skills';

        require get_view_dir('skills/index');
    }

    public function create()
    {
        $title = 'Add Skill';

        require get_view_dir('skills/create');
    }

    public function store()
    {
        $validated = [
            'name' => (new Validations($_POST['name']))
                ->notEmpty()
                ->isName(),
        ];

        $skill = check_validation_and_get_data($validated);

        (new Skill())->insert($skill);

        redirect_with_msgs(
            make_url('/admin/skills'),
            ['success' => 'Skill added successfully.']
        );
    }

    public function show()
    {
        $id = (int)$_GET['id'];

        $skill = (new Skill())->find($id);

        if (!$skill)
            redirect_with_msgs(make_url('/admin/skills'), ['error' => 'Skill not found.']);

        $title = 'Show Skill';

        require get_view_dir('skills/show');
    }

    public function edit()
    {
        $id = (int)$_GET['id'];

        $skill = (new Skill())->find($id);

        if (!$skill)
            redirect_with_msgs(make_url('/admin/skills'), ['error' => 'Skill not found.']);

        $title = 'Edit Skill';

        require get_view_dir('skills/edit');
    }

    public function update()
    {
        $id = (int)$_GET['id'];

        $validated = [
            'name' => (new Validations($_POST['name']))
                ->notEmpty()
                ->isName(),
        ];

        $skill = check_validation_and_get_data($validated);

        (new Skill())->update($skill, ['id' => $id]);

        redirect_with_msgs(
            make_url('/admin/skills'),
            ['success' => 'Skill updated successfully.']
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
            (new Skill())->delete($id);
        }

        redirect_with_msgs(
            make_url('/admin/skills'),
            ['success' => 'Skill deleted successfully.']
        );
    }

    public function skills_api()
    {
        $skills = (new Skill())->all();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($skills);
    }
}
