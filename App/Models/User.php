<?php

namespace App\Models;

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
}
