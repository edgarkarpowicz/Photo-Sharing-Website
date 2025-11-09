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

$Nuevo_TEL = $_POST['phone'];
$Nombre = $_SESSION['account_name'];
$Apellido = $_SESSION['account_surname'];
$Nickname = $_SESSION['account_nickname'];

$phoneVerification = file_get_contents("https://phonevalidation.abstractapi.com/v1/?api_key=0093ffaa0a224ab282fdb49684dff00f&phone={$Nuevo_TEL}");
$output = json_decode($phoneVerification);
    
if ($output && isset($output->valid) && $output->valid === false) {
    header("Location: ../php/error_cambios_miperfil.php"); 
    die();
}

mysqli_query($conn, "CALL CAMBIAR_TEL('$Nombre', '$Apellido', '$Nickname', '$Nuevo_TEL')");

header("Location: ../php/Mi_Perfil.php");
$conn->close();
?>