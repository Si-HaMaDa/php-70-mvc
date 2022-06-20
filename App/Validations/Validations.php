<?php

namespace App\Validations;

class Validations
{
    public $value;
    public $error = false;
    public $messages = [];

    public function __construct($value)
    {
        $this->value = $this->startFilltering($value);
    }

    public function startFilltering($value)
    {
        if (isset($value["tmp_name"]) || is_array($value)) return $value;
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    public function isNullable()
    {
        if (
            !isset($this->value)
            || empty($this->value)
            || (isset($this->value["tmp_name"]) && empty($this->value["tmp_name"]))
        ) {
            $this->value = null;
            $this->error = false;
            $this->messages[] = "Value is nullable!";
        }
        return $this;
    }

    public function isIsset()
    {
        if (!isset($this->value)) {
            $this->error = true;
            $this->messages[] = "Value is not set!";
        }
        return $this;
    }

    public function isArray()
    {
        if (!is_array($this->value)) {
            $this->error = true;
            $this->messages[] = "Value must be Array!";
        }
        return $this;
    }

    public function arrayValues($is)
    {
        foreach ($this->value as $value) {
            $val = (new Validations($value))->$is();
            if ($val->error) {
                $this->error = true;
                $this->messages = array_merge($this->messages, $val->messages);
            }
        }
        return $this;
    }

    public function notEmpty()
    {
        if (empty($this->value)) {
            $this->error = true;
            $this->messages[] = "Value is Empty!";
        }
        return $this;
    }

    public function isName()
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $this->value)) {
            $this->error = true;
            $this->messages[] = "Only letters and white space allowed!";
        }
        return $this;
    }

    public function isEmail()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->error = true;
            $this->messages[] = "Invalid Email!";
        }
        return $this;
    }

    public function isInteger()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_INT)) {
            $this->error = true;
            $this->messages[] = "Value is not Integer!";
        }
        return $this;
    }

    public function isString()
    {
        if (!preg_match("/^[a-zA-Z0-9-' ]*$/", $this->value)) {
            $this->error = true;
            $this->messages[] = "Value is not String!";
        }
        return $this;
    }

    public function isIn($in = [])
    {
        if (!in_array($this->value, $in)) {
            $this->error = true;
            $this->messages[] = "Value is not in allowed values!";
        }
        return $this;
    }

    public function min($number = 6)
    {
        if (strlen($this->value) < $number) {
            $this->error = true;
            $this->messages[] = "Value must be More than $number!";
        }
        return $this;
    }

    public function max($number = 225)
    {
        if (strlen($this->value) > $number) {
            $this->error = true;
            $this->messages[] = "Value must be Less than $number!";
        }
        return $this;
    }

    public function confirmed($confirmation)
    {
        if ($this->value != $this->startFilltering($confirmation)) {
            $this->error = true;
            $this->messages[] = "Value must be confirmed!";
        }
        return $this;
    }

    protected function checkFile($file = null)
    {
        $file = $file ?? $this->value["tmp_name"];
        return is_file($file);
    }

    public function isFile()
    {
        if ($this->checkFile() == false) {
            $this->error = true;
            $this->messages[] = "Input is not a File.";
        }
        return $this;
    }

    public function fileSize($size = 500)
    {
        $ckSize = $size * 1000; // Convert to kb
        if ($this->checkFile() == true) {
            $fileSize = filesize($this->value["tmp_name"]);
            if ($fileSize > $ckSize) {
                $this->error = true;
                $this->messages[] = "File size is more than $size KB!";
            }
        }
        return $this;
    }

    public function isImage()
    {
        $check = $this->checkFile() ? getimagesize($this->value["tmp_name"]) : false;
        if ($check == false) {
            $this->error = true;
            $this->messages[] = "Input is not an image.";
        }
        return $this;
    }

    public function extensionIn($in = [])
    {
        $extension = isset($this->value['name']) ? strtolower(pathinfo($this->value['name'], PATHINFO_EXTENSION)) : null;
        if (!$extension || !in_array($extension, $in)) {
            $this->error = true;
            $this->messages[] = "Value is not in allowed extensions!";
        }
        return $this;
    }

    public function checkErrors()
    {
        return $this->error;
    }

    public static function check_validation_and_get_data($validated)
    {
        $errors = [];
        foreach ($validated as $key => $value) {
            if ($value->error) {
                $errors[$key] = implode('<br>', $value->messages);
            }
        }

        if (!empty($errors)) {
            redirect_with_msgs(
                $_SERVER['HTTP_REFERER'],
                [
                    'error' => 'Please fix the errors below.',
                    'errors' => $errors,
                    'old' => $_POST
                ]
            );
            return;
        }

        $data = [];
        foreach ($validated as $key => $value) {
            $data[$key] = $value->value;
        }

        return $data;
    }
}
