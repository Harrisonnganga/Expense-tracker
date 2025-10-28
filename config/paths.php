<?php
//  Path configuration

define('ROOT_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('STORAGE_PATH', ROOT_PATH . '/storage');

// URL helpers
function asset($path) {
    return '/' . ltrim($path, '/');
}

function url($path = '') {
    return 'http://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/');
}
