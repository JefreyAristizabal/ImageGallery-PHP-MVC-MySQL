<?php

$routes = require_once __DIR__ . '/../Routes/web.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Aquí defines el prefijo base de tu proyecto:
$basePath = '/Arquitectura_MVC/public';

// Quita ese prefijo si está al principio:
if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

$requestUri = rtrim($requestUri, '/') ?: '/';


foreach ($routes as $route => $action) {
    $pattern = preg_replace('/\{[a-zA-Z_]+\}/', '([0-9]+)', $route);
    $pattern = '#^' . rtrim($pattern, '/') . '/?$#';  // barra final opcional

    // echo "Probando patrón: $pattern con URI: $requestUri<br>";

    if (preg_match($pattern, $requestUri, $matches)) {
        // echo "¡Coincidencia encontrada con la ruta: $route<br>";

        if (isset($action['type']) && $action['type'] === 'view') {
            include __DIR__ . '/../Views/' . $action['view'];
            exit;
        }

        $controllerName = $action['controller'];
        $methodName = $action['method'];

        require_once __DIR__ . '/../Controllers/' . $controllerName . '.php';
        $controller = new $controllerName();

        array_shift($matches);
        call_user_func_array([$controller, $methodName], $matches);
        exit;
    }
}

http_response_code(404);
echo "404 - Página no encontrada";
