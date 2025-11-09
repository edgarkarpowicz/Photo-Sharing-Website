<?php
session_start();
$servername = "localhost"; // or the server address provided by your web host
$username = "picify_db_editor"; // your database username
$password = "#Ek11Mn35Gr06#"; // your database password
$database = "picify_new_final_database"; // your database name

$conn = new mysqli($servername, $username, $password, $database);

$Nombre = $_SESSION['account_name'];
$Apellido = $_SESSION['account_surname'];
$Email = $_SESSION['account_email'];
$Nickname = $_SESSION['account_nickname'];

$GALLERY_NAME = $_POST['name'];
$GALLERY_DESC = $_POST['description'];
$FILENAME = $_FILES["fileToUpload"]["name"];

$target_dir = "../galleryPictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    header("Location: ../php/creargaleria_error.php");
    die();
}

if (!empty($Nombre) || !empty($Apellido) || !empty($Email) || !empty($Phone) || !empty($Nickname)) {
    if (mysqli_connect_error()) {
        header("Location: ../php/creargaleria_error.php");
        die();
    } else {
        $object = mysqli_query($conn, "CALL GET_ID('$Nombre', '$Apellido', '$Email', '$Nickname')");
        $result = mysqli_fetch_array($object);
        $USER_ID = $result[0];
        $object->close();
        $conn->next_result();

        mysqli_query($conn, "CALL INSERTAR_GALERIA('$USER_ID', '$GALLERY_NAME', '$GALLERY_DESC', '$FILENAME')");
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
        header("Location: ../php/Mis_Galerias.php");
        $conn->close();
    }
} else {
    header("Location: ../php/creargaleria_error.php");
}
$conn->close();
?>