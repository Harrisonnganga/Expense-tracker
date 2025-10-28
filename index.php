<?php
// index.php - Simplified Main Router

// Start session first
session_start();

// Simple autoloader
spl_autoload_register(function ($className) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Load configuration
require_once 'config/paths.php';
require_once 'config/DB.php';

// Simple routing
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = rtrim($path, '/');

$routes = [
    '/' => 'HomeController@index',
    '/login' => 'AuthController@login',
    '/logout' => 'AuthController@logout', 
    '/dashboard' => 'DashboardController@index',
    '/setup' => 'SetupController@index',
    '/test-db' => 'TestController@database'
];

// Find matching route
$controller = null;
$method = 'index';

foreach ($routes as $route => $action) {
    if ($path === $route) {
        list($controller, $method) = explode('@', $action);
        break;
    }
}

// Default to home if no route found
if (!$controller) {
    $controller = 'HomeController';
    $method = 'index';
}

// Load and execute controller
$controllerFile = "app/controllers/{$controller}.php";
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    if (class_exists($controller)) {
        $controllerInstance = new $controller();
        if (method_exists($controllerInstance, $method)) {
            $controllerInstance->$method();
        } else {
            show_error("Method {$method} not found in {$controller}");
        }
    } else {
        show_error("Class {$controller} not found");
    }
} else {
    show_error("Controller file {$controllerFile} not found");
}

function show_error($message) {
    http_response_code(404);
    echo "<h1>Application Error</h1>";
    echo "<p>{$message}</p>";
    echo "<a href='/'>Go Home</a>";
    exit;
}
