<?php

// if (php_sapi_name() != 'cli') die('404');

// die($_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME']);
// die(realpath($_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME']));

// die(__FILE__);
// die(realpath(__FILE__));

if (realpath(__FILE__) == realpath($_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME'])) die('404');
