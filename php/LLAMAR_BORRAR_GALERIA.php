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

$GALLERY_ID = $_POST['internal_id'];
$GALLERY_NAME = $_POST['name'];

$object = mysqli_query($conn, "CALL GET_ID('$Nombre', '$Apellido', '$Email', '$Nickname')");
$result = mysqli_fetch_array($object);
$ID = $result['ID'];
$object->close();
$conn->next_result();

mysqli_query($conn, "CALL BORRAR_GALERIA('$GALLERY_ID', '$ID', '$GALLERY_NAME')");

header("Location: ../php/Mis_Galerias.php");
$conn->close();
?>