<?php
// router.php

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$file = __DIR__ . $path;

// Si el archivo existe y no es directorio, lo sirve directamente
if (is_file($file)) {
    return false; // dejar que el servidor embebido lo sirva
}

// Si no existe archivo, cargar el front controller
require_once __DIR__ . '/Views/index.php';

// Si se accede a una ruta no definida, redirigir a la página de inicio
if (!file_exists($file)) {
    header("Location: /");
    exit;
}
