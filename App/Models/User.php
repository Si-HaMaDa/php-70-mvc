<?php

namespace App\Models;

use App\Database\DB;

class User extends MainModel
{
    public const UP_IMG_DIR = '/uploads/users/';
    // protected $table = 'users';
    public function table()
    {
        return 'users';
    }

    public static function upload_image($image, $id = null)
    {

        if ($id) self::delete_image($id);

        if (!is_dir(MAIN_DIR . self::UP_IMG_DIR)) mkdir(MAIN_DIR . self::UP_IMG_DIR);

        $image_name = 'user-' . time() . '-' . $image['name'];
        $image_path = MAIN_DIR . self::UP_IMG_DIR . $image_name;

        // var_dump($image_name);
        // die;

        if (move_uploaded_file(
            $image['tmp_name'],
            $image_path
        ))
            return $image_name;

        return false;
    }

    public static function get_image($user)
    {
        return make_url(self::UP_IMG_DIR . $user['image']);
    }

    public static function delete_image($id)
    {
        $user = (new User())->find($id);
        $path = MAIN_DIR . self::UP_IMG_DIR . $user['image'];
        unlink($path);
    }

    public function delete($id)
    {
        // delete image of user if exist
        self::delete_image($id);
        // run delete method from parent class to delete the user from database
        parent::delete($id);
    }

    public function save_skills($user_id, $skills)
    {
        DB::object()->deleteWhere('skill_user', ['user_id' => $user_id]);
        foreach ($skills as $skill) {
            DB::object()->insert('skill_user', [
                'skill_id' => $skill,
                'user_id' => $user_id,
            ]);
        }
        return true;
    }

    public function get_skills($user_id)
    {
        $sql = DB::object()->connection->prepare(
            "SELECT skills.id, skills.name FROM skill_user
            INNER JOIN skills ON skill_user.skill_id = skills.id
            WHERE skill_user.user_id = $user_id"
        );
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
}
