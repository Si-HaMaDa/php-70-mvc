<?php

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
        $route = str_replace(SUB_DIR, '', $route);
        // Remove any query params
        $route = explode('?', $route)[0];
        // Remove the last slash
        $route = rtrim($route, '/');
    }
}
