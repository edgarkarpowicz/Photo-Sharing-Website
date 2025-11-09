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

$GALLERY_ID = $_POST['gallery_id'];
$PICTURE_ID = $_POST['picture_id'];

mysqli_query($conn, "CALL BORRAR_RELACION_EXHIBIDOS('$GALLERY_ID', '$PICTURE_ID')");
$conn->next_result();

header("Location: ../php/Mis_Galerias.php");
$conn->close();
?>