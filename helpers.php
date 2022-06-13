<?php

if (!function_exists('make_url')) {
    function make_url($url)
    {
        return FULL_URL . $url;
    }
}
