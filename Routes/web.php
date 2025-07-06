<?php

// web.php

return [
    '/' => ['type' => 'view', 'view' => 'index.php'], // Ruta principal
    '/user' => ['controller' => 'UsersController', 'method' => 'getAllUsersIndex'],
    '/user/createDefault' => ['controller' => 'UsersController', 'method' => 'insertDefaultUser'],
    '/users' => ['controller' => 'UsersController', 'method' => 'getAllUsers'],
    '/user/create' => ['controller' => 'UsersController', 'method' => 'handleCreateUser'],
    '/user/delete/{id}' => ['controller' => 'UsersController', 'method' => 'deleteUser'],
    '/user/update/{id}' => ['controller' => 'UsersController', 'method' => 'handleUpdateUser'],
    '/photo/upload' => ['controller' => 'PhotosController', 'method' => 'handlePhotoUpload'],
    '/photo/delete/{id}' => ['controller' => 'PhotosController', 'method' => 'deletePhoto'],
    '/photo/update/{id}' => ['controller' => 'PhotosController', 'method' => 'handleUpdatePhoto'],
    '/photo' => ['controller' => 'PhotosController', 'method' => 'getAllPhotos'],
    '/login' => ['type' => 'view', 'view' => 'login.php'], // Login sin controlador
    '/auth/login' => ['controller' => 'AuthController', 'method' => 'handleLoginRequest'],
    '/logout' => ['controller' => 'AuthController', 'method' => 'logout'],
];
