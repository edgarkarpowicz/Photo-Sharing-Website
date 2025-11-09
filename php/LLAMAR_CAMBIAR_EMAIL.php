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

$Nuevo_EMAIL = $_POST['email'];
$Nombre = $_SESSION['account_name'];
$Apellido = $_SESSION['account_surname'];
$Nickname = $_SESSION['account_nickname'];

$mailVerification = file_get_contents("https://api.quickemailverification.com/v1/verify?email={$Nuevo_EMAIL}&apikey=5e4b200f2217c6665685e2e3ff57609fbf8fb63bcebf8318bb7a48d8eeac");
$mailOutput = json_decode($mailVerification);
    
if ($mailOutput && ($mailOutput->result == "invalid" || $mailOutput->result == "unknown")) {
    header("Location: ../php/error_cambios_miperfil.php"); 
    die();
}

$result = mysqli_query($conn, "CALL CHECK_EMAIL('$Nuevo_EMAIL')");

if($result->num_rows == 0) {
    $result->close();
    $conn->next_result();
    mysqli_query($conn, "CALL CAMBIAR_EMAIL('$Nombre', '$Apellido', '$Nickname', '$Nuevo_EMAIL')");
    $_SESSION['account_email'] = $Nuevo_EMAIL;
    header("Location: ../php/Mi_Perfil.php"); 
    die();
} else {
    header("Location: ../php/error_cambios_miperfil.php"); 
    die();
}

$conn->close();
?>