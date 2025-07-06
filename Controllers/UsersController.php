<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../models/Users.php';
require_once __DIR__ . '/PhotosController.php';

class UsersController {
    private $conn;
    private $connection;

    public function __construct()
    {
        $this->connection = new Database("root", "", "galery", "localhost");
        $this->conn = $this->connection->openConnection();
    }

    public function getAllUsers() {
        $stmt = "SELECT * FROM users";
        $users = [];

        $result_set = mysqli_query($this->conn, $stmt)
            or die("ERROR: " . mysqli_error($this->conn));

        if (mysqli_num_rows($result_set) > 0) {
            while ($row = mysqli_fetch_assoc($result_set)) {
                $u = new Users(
                    $row['username'], 
                    $row['password'], 
                    $row['last_session'], 
                    $row['created_at'], 
                    $row['role'], 
                    $row['status'], 
                    $row['profile_picture'], 
                    $row['id_user']
                );

                $u->setIdUser($row['id_user']);
                $u->setUsername($row['username']);
                $u->setPassword($row['password']);
                $u->setLastSession($row['last_session']);
                $u->setCreatedAt($row['created_at']);
                $u->setRole($row['role']);
                $u->setStatus($row['status']);
                $u->setProfilePicture($row['profile_picture']);

                $users[] = $u;
            }
        }

        // No cerrar aquí la conexión si vas a reutilizarla
        // mysqli_close($this->conn);

        return $users;
    }

    public function getAllUsersIndex(){
        $users = $this->getAllUsers();
        $photosController = new PhotosController();
        $photos = $photosController->getAllPhotos(); // Obtener fotos para la vista
        include __DIR__ . '/../views/admindashboard.php';
    }

    public function insertUser($user)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (username, password, last_session, role, status, profile_picture) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("ERROR en prepare: " . $this->conn->error);
        }

        $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));

        $username = $user->getUsername();
        $password = $user->getPassword();
        $lastSession = $user->getLastSession();
        $role = $user->getRole();
        $status = $user->getStatus();
        $profilePicture = $user->getProfilePicture();

        $stmt->bind_param("ssssss", $username, $password, $lastSession, $role, $status, $profilePicture);

        if (!$stmt->execute()) {
            die("ERROR al insertar usuario: " . $stmt->error);
        }

        $insertedId = $stmt->insert_id;
        $stmt->close();

        return $insertedId;
    }

    public function deleteUser($id_user)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id_user = ?");
        if (!$stmt) {
            die("ERROR en prepare: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id_user);

        if (!$stmt->execute()) {
            die("ERROR al eliminar usuario: " . $stmt->error);
        }

        $deleted = $stmt->affected_rows > 0;
        $stmt->close();
        header('Location: /user'); // Redirigir después de eliminar
        return $deleted;
    }

    public function updateUser($user)
    {
        $stmt = $this->conn->prepare("
            UPDATE users SET 
                username = ?, 
                password = ?, 
                last_session = ?, 
                role = ?, 
                status = ?, 
                profile_picture = ?
            WHERE id_user = ?
        ");

        if (!$stmt) {
            die("ERROR en prepare: " . $this->conn->error);
        }

        $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));

        $username = $user->getUsername();
        $password = $user->getPassword();
        $lastSession = $user->getLastSession();
        $role = $user->getRole();
        $status = $user->getStatus();
        $profilePicture = $user->getProfilePicture();
        $idUser = $user->getIdUser();

        $stmt->bind_param("ssssssi", $username, $password, $lastSession, $role, $status, $profilePicture, $idUser);

        if (!$stmt->execute()) {
            die("ERROR al actualizar usuario: " . $stmt->error);
        }

        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows > 0;
    }

    public function insertDefaultUser() {
        $newUser = new Users(
            "juan",
            "123456",
            "2025-06-03 05:05:05",
            date("Y-m-d H:i:s"),
            "admin",
            "active",
            "default.png"
        );

        $this->insertUser($newUser);
        echo "Usuario insertado correctamente.";
    }


    // === NUEVOS MÉTODOS PARA FORMULARIOS POST ===

    // Procesa el formulario de creación enviado via POST
    public function handleCreateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $status = $_POST['status'];
            $profilePicture = !empty($_POST['profile_picture']) ? $_POST['profile_picture'] : 'default.png';
            $lastSession = !empty($_POST['last_session']) ? $_POST['last_session'] : date('Y-m-d H:i:s');

            $user = new Users(
                $username,
                $password,
                $lastSession,
                date('Y-m-d H:i:s'),
                $role,
                $status,
                $profilePicture
            );

            $insertedId = $this->insertUser($user);

            if ($insertedId) {
                header('Location: /user');
                exit;
            } else {
                echo "Error al insertar usuario.";
            }
        } else {
            // Si acceden por GET, redirige
            header('Location: /user');
            exit;
        }
    }

    // Procesa el formulario de actualización enviado via POST
    public function handleUpdateUser($id_user)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $status = $_POST['status'];
            $profilePicture = !empty($_POST['profile_picture']) ? $_POST['profile_picture'] : 'default.png';
            $lastSession = !empty($_POST['last_session']) ? $_POST['last_session'] : date('Y-m-d H:i:s');

            $user = new Users(
                $username,
                $password,
                $lastSession,
                date('Y-m-d H:i:s'),
                $role,
                $status,
                $profilePicture,
                $id_user
            );

            $updated = $this->updateUser($user);

            if ($updated) {
                header('Location: /user');
                exit;
            } else {
                echo "Error al actualizar usuario.";
            }
        } else {
            // Aquí podrías cargar un formulario para editar (GET)
            header('Location: /user');
            exit;
        }
    }

}
