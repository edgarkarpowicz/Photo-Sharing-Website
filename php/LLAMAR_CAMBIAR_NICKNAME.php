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

$Nuevo_NICKNAME = $_POST['nickname'];
$Old_Nickname = $_SESSION['account_nickname'];
$Nombre = $_SESSION['account_name'];
$Apellido = $_SESSION['account_surname'];
$Email = $_SESSION['account_email'];

$result = mysqli_query($conn, "CALL CHECK_NICKNAME('$Nuevo_NICKNAME')");

if($result->num_rows == 0) {
    $result->close();
    $conn->next_result();
    mysqli_query($conn, "CALL CAMBIAR_NICKNAME_FOTOS('$Old_Nickname', '$Nuevo_NICKNAME')");
    mysqli_query($conn, "CALL CAMBIAR_NICKNAME('$Nombre', '$Apellido', '$Email', '$Nuevo_NICKNAME')");
    $_SESSION['account_nickname'] = $Nuevo_NICKNAME;
    header("Location: ../php/Mi_Perfil.php"); 
    die();
} else {
    header("Location: ../php/error_cambios_miperfil.php"); 
    die();
}

$conn->close();
?>