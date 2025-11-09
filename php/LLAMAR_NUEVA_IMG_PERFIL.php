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

$target_dir = "../profilePictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// echo $target_dir; // Directorio donde se va a guardar la IMG 
// echo $target_file; // Directorio Completo 
// echo $_FILES["fileToUpload"]["name"]; // Nombre del Archivo
// echo $uploadOk; // Si esta bien para subir -- Secundario -- Para hacer checkeos como si el Archivo Existe, Si es una Imágen, Para Limitar el Tamaño del Archivo, Solo permitir ciertos Formatos de Imagen, etc. 
// echo $imageFileType; // Tipo del Archivo. PNG, JPG, etc.

$filename = $_FILES["fileToUpload"]["name"];
$Nombre = $_SESSION['account_name'];
$Apellido = $_SESSION['account_surname'];
$Nickname = $_SESSION['account_nickname'];

// echo $filename;
// echo $Nombre;
// echo $Apellido;
// echo $target_file;

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    header("Location: ../php/nueva_img_perfil_error.php");
    die();
}

mysqli_query($conn, "CALL CARGAR_IMG_PERFIL('$filename', '$Nombre', '$Apellido', '$Nickname')");

if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
    // echo "<h3> Imágen subida con exito! </h3>";
} else {
    // echo "<h3> Imágen no subida! </h3>";
}

header("Location: ../php/Mi_Perfil.php");
$conn->close();
?>