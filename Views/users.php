<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
</head>
<body>
    <h1>Listado de Usuarios</h1>
    <?php if (!empty($users)): ?>
        <ul>
            <?php foreach ($users as $user): ?>
                <li><?php echo htmlspecialchars($user->getUsername()); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay usuarios para mostrar.</p>
    <?php endif; ?>

    <a href="./user/createDefault">Crear usuario</a>
    <a href="./login">Ir al login</a>
</body>
</html>
