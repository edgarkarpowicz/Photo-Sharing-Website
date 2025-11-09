<?php
session_start();

$servername = "localhost"; // or the server address provided by your web host
$username = "picify_db_editor"; // your database username
$password = "#Ek11Mn35Gr06#"; // your database password
$database = "picify_new_final_database"; // your database name

$conn = new mysqli($servername, $username, $password, $database);

if (mysqli_connect_error()) {
    echo "No se pudo conectar a la Base de Datos";
    die();
}

$Nombre = $_SESSION['account_name'];
$Apellido = $_SESSION['account_surname'];
$Email = $_SESSION['account_email'];
$Nickname = $_SESSION['account_nickname'];

$GALLERY_ID = $_POST['id'];
$NEW_GALLERY_NAME = $_POST['name'];
$NEW_GALLERY_DESC = $_POST['description'];
$NEW_FILENAME = $_FILES["fileToUpload"]["name"];

$target_dir = "../galleryPictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$object = mysqli_query($conn, "CALL GET_ID('$Nombre', '$Apellido', '$Email', '$Nickname')");
$result = mysqli_fetch_array($object);
$ID = $result['ID'];
$object->close();
$conn->next_result();

if (!empty($NEW_GALLERY_NAME)) {
    mysqli_query($conn, "CALL UPDATE_GALERIA_NOMBRE('$NEW_GALLERY_NAME', '$ID', '$GALLERY_ID')");
    $conn->next_result();
}

if (!empty($NEW_GALLERY_DESC)) {
    mysqli_query($conn, "CALL UPDATE_GALERIA_DESC('$NEW_GALLERY_DESC', '$ID', '$GALLERY_ID')");
    $conn->next_result();
}

if (!empty($NEW_FILENAME)) {
    if ($imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        header("Location: ../php/Mis_Galerias.php");
        die();
    }
    mysqli_query($conn, "CALL UPDATE_GALERIA_IMG('$NEW_FILENAME', '$ID', '$GALLERY_ID')");
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
    $conn->next_result();
}

header("Location: ../php/Mis_Galerias.php");
$conn->close();
?>