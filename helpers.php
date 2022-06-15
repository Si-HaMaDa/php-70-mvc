<?php

if (!function_exists('get_view')) {
    function get_view($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/views/' . $view . '.view.php';
    }
}

if (!function_exists('get_view_dir')) {
    function get_view_dir($view)
    {
        return __DIR__ . '/views/' . $view . '.view.php';
    }
}

if (!function_exists('make_url')) {
    function make_url($url)
    {
        return FULL_URL . $url;
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

if (!function_exists('check_allowed_method')) {
    function check_allowed_method($method)
    {
        if ($_SERVER['REQUEST_METHOD'] == $method) return;
        http_response_code(405);
        echo "This page is only for $method requests";
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

if (!function_exists('set_session_message')) {
    function set_session_message($type, $message)
    {
        $_SESSION[$type] = $message;
    }
}

if (!function_exists('get_session_message')) {
    function get_session_message($type, $clear = true)
    {
        if (!isset($_SESSION[$type])) return;
        $message = $_SESSION[$type];
        if ($clear) unset($_SESSION[$type]);
        return $message;
    }
}

if (!function_exists('set_session_error')) {
    function set_session_error($message)
    {
        set_session_message('error', $message);
    }
}

if (!function_exists('get_session_error')) {
    function get_session_error($clear = true)
    {
        return get_session_message('error', $clear);
    }
}

if (!function_exists('set_session_success')) {
    function set_session_success($message)
    {
        set_session_message('success', $message);
    }
}

if (!function_exists('get_session_success')) {
    function get_session_success($clear = true)
    {
        return get_session_message('success', $clear);
    }
}

if (!function_exists('redirect_with_msg')) {
    function redirect_with_msgs($url, $messages = [])
    {
        if (!empty($messages)) {
            foreach ($messages as $type => $text) {
                set_session_message($type, $text);
            }
        }
        header('Location: ' . $url);
        die();
    }
}

if (!function_exists('get_old_value')) {
    function get_old_value($key)
    {
        if (!isset($_SESSION['old'][$key])) return;

        $value = $_SESSION['old'][$key];
        unset($_SESSION['old'][$key]);
        return $value ?? '';
    }
}
