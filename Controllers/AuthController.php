<?php
session_start();

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../models/Users.php';

class AuthController {
    private $conn;
    private $connection;

    public function __construct() {
        $this->connection = new Database("root", "", "galery", "localhost");
        $this->conn = $this->connection->openConnection();
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                // Autenticación correcta
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['logged_in'] = true;

                // Actualizar fecha de última sesión
                $now = date('Y-m-d H:i:s');
                $update = $this->conn->prepare("UPDATE users SET last_session = ? WHERE id_user = ?");
                $update->bind_param("si", $now, $row['id_user']);
                $update->execute();

                header('Location: /user');
                exit;
            }
        }

        // Si falló la autenticación
        $_SESSION['login_error'] = "Credenciales incorrectas";
        header('Location: /login');
        exit;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }

    public function showLoginForm() {
        include __DIR__ . '/../views/login.php';
    }

    public function handleLoginRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $this->login($username, $password);
        } else {
            $this->showLoginForm();
        }
    }

    public function __destruct() {
        $this->connection->closeConnection();
    }
}
