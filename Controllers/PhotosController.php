<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../models/Photos.php';

class PhotosController {
    private $conn;
    private $connection;

    public function __construct()
    {
        $this->connection = new Database("root", "", "galery", "localhost");
        $this->conn = $this->connection->openConnection();
    }

    public function getAllPhotos() {
        $stmt = "SELECT * FROM photos";
        $photos = [];

        $result_set = mysqli_query($this->conn, $stmt)
            or die("ERROR: " . mysqli_error($this->conn));

        if (mysqli_num_rows($result_set) > 0) {
            while ($row = mysqli_fetch_assoc($result_set)) {
                $p = new Photos(
                    $row['photo'], 
                    $row['category'], 
                    $row['id_photo']
                );

                $p->setIdPhoto($row['id_photo']);
                $p->setPhoto($row['photo']);
                $p->setCategory($row['category']);

                $photos[] = $p;
            }
        }

        // No cerrar aquí la conexión si vas a reutilizarla
        // mysqli_close($this->conn);

        return $photos;
    }

    public function getAllPhotosIndex(){
        $photos = $this->getAllPhotos();
        include __DIR__ . '/../views/admindashboard.php';
    }

    public function insertPhoto($photo)
    {
        // insertar foto con un identificador por tiempo actual
        $stmt = "INSERT INTO photos (photo, category) VALUES (?, ?)";
        $stmt = mysqli_prepare($this->conn, $stmt);
        mysqli_stmt_bind_param($stmt, "ss", $photo->getPhoto(), $photo->getCategory());
        mysqli_stmt_execute($stmt); 
        $photo->setIdPhoto(mysqli_insert_id($this->conn)); // Obtener el ID de la foto insertada
        mysqli_stmt_close($stmt);
        return $photo; // Retornar el objeto foto con el ID asignado
    }

    public function updatePhoto($photo)
    {
        $stmt = "UPDATE photos SET photo = ?, category = ? WHERE id_photo = ?";
        $stmt = mysqli_prepare($this->conn, $stmt);
        mysqli_stmt_bind_param($stmt, "ssi", $photo->getPhoto(), $photo->getCategory(), $photo->getIdPhoto());
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function deletePhoto($id_photo)
    {
        $stmt = "DELETE FROM photos WHERE id_photo = ?";
        $stmt = mysqli_prepare($this->conn, $stmt);
        mysqli_stmt_bind_param($stmt, "i", $id_photo);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function createPhoto(){
        include __DIR__ . '/../views/createPhoto.php';
    }


    // Manejar la entrada de POST para insertar una foto
    public function handlePhotoUpload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $category = $_POST['category'] ?? '';
            $file = $_FILES['photo'];

            $photoName = time() . '_' . basename($file['name']);
            $targetDir = __DIR__ . '/../public/img/';
            $targetFile = $targetDir . $photoName;

            if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
                echo "❌ No se pudo guardar la imagen.";
                return;
            }

            $photo = new Photos($photoName, $category);
            $this->insertPhoto($photo);

            header("Location: /user");
            exit;
        } else {
            echo "❌ Datos inválidos.";
        }
    }


    public function __destruct()
    {
        $this->connection->closeConnection();
    }
}