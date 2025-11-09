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

$date = $_POST['date'];
$desc = $_POST['description'];
$picture_id = $_POST['internal_id'];

$target_dir = "../uploadedPictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// echo $target_dir; // Directorio donde se va a guardar la IMG 
// echo $target_file; // Directorio Completo 
// echo $_FILES["fileToUpload"]["name"]; // Nombre del Archivo
// echo $uploadOk; // Si esta bien para subir -- Secundario -- Para hacer checkeos como si el Archivo Existe, Si es una Imágen, Para Limitar el Tamaño del Archivo, Solo permitir ciertos Formatos de Imagen, etc. 
// echo $imageFileType; // Tipo del Archivo. PNG, JPG, etc.

//$object = mysqli_query($conn, "CALL GET_ID('$Nombre', '$Apellido', '$Email', '$Nickname')");
//$result = mysqli_fetch_array($object);
//$ID = $result['ID'];
//$object->close();

//$conn->next_result();

$owner = $_SESSION['account_nickname'];

$another = mysqli_query($conn, "CALL BORRAR_FOTO('$date', '$desc', '$owner', '$picture_id')");

if (!$another) {
    // die('Error: ' . mysqli_error($conn));
    die();
} else {
    // echo "Funciona";
}

header("Location: ../php/Sección_MisFotos.php");
$conn->close();
?>