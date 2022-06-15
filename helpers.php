<?php

if (!function_exists('make_url')) {
    function make_url($url)
    {
        return FULL_URL . $url;
    }
}

if (!function_exists('get_view_dir')) {
    function get_view_dir($view)
    {
        return __DIR__ . '/views/' . $view . '.view.php';
    }
}

if (!function_exists('get_view')) {
    function get_view($view, $data = [])
    {
        extract($data);
        require get_view_dir($view);
        die();
    }
}

if (!function_exists('get_route')) {
    function get_route()
    {
        // Get the method name from the URL
        $route = $_SERVER['REQUEST_URI'];
        // Replace the Subfolder with an empty string
        $route = str_replace(SUB_FOLDER, '', $route);
        // Remove any query params
        $route = explode('?', $route)[0];
        // Remove the last slash
        $route = rtrim($route, '/');

        return $route;
    }
}

if (!function_exists('check_allowed_methods')) {
    function check_allowed_methods($methods)
    {
        if ($_SERVER['REQUEST_METHOD'] == $methods) return;

        http_response_code(405);
        echo "This page is only for $methods requests";
        die();
        return;
    }
}

if (!function_exists('set_session_message')) {
    function set_session_message($type, $message)
    {
        $_SESSION[$type] = $message;
    }
}

if (!function_exists('set_success_message')) {
    function set_success_message($message)
    {
        set_session_message('success', $message);
    }
}

if (!function_exists('set_error_message')) {
    function set_error_message($message)
    {
        set_session_message('error', $message);
    }
}

if (!function_exists('get_error_message')) {
    function get_error_message($remove = true)
    {
        $error = $_SESSION['error'];
        if ($remove) unset($_SESSION['error']);
        return $error;
    }
}

if (!function_exists('redirect_with_msg')) {
    function redirect_with_msg($url, $messages = [])
    {
        if (!empty($messages)) {
            foreach ($messages as $key => $value) {
                set_session_message($key, $value);
            }
        }
        header('Location: ' . $url);
        die();
    }
}

if (!function_exists('check_validation_and_get_data')) {
    function check_validation_and_get_data($validated)
    {
        $errors = [];
        foreach ($validated as $key => $value) {
            if ($value->error) {
                $errors[$key] = implode('<br>', $value->messages);
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
            return;
        }

        $data = [];
        foreach ($validated as $key => $value) {
            $data[$key] = $value->value;
        }

        return $data;
    }
}
