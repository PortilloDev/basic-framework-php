<?php

require  __DIR__ . '/../framework/Database.php';
require  __DIR__ . '/../framework/Validator.php';

$db = new Database();
$routes = require __DIR__ . '/../routes/web.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = $routes[$requestUri] ?? null;
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($route) {
    require  __DIR__ . '/../' .$route;
} else {
    http_response_code(404);
    echo "404 Not Found";
}