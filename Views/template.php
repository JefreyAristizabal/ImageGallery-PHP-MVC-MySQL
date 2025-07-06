<?php

require_once __DIR__ . '/../Models/Users.php';
require_once __DIR__ . '/../Controllers/Database.php';
require_once __DIR__ . '/../Controllers/UsersController.php';

$controller = new UsersController(); // ✅ crea el objeto

$newUser = new Users(
    "juan",
    "123456",
    "2025-06-03 05:05:05",
    date("Y-m-d H:i:s"),
    "user",
    "active",
    "default.png"
);

$insertedId = $controller->insertUser($newUser);

if ($insertedId) {
    echo "Usuario insertado con ID: " . $insertedId;
} else {
    echo "Error al insertar usuario.";
}
