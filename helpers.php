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
