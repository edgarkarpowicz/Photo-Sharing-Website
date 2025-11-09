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

$PICTURE_ID = $_POST['id'];
$GALLERY_NAME = $_POST['name'];

$object = mysqli_query($conn, "CALL GET_ID('$Nombre', '$Apellido', '$Email', '$Nickname')");
$result = mysqli_fetch_array($object);
$ID = $result['ID'];
$object->close();
$conn->next_result();

$object = mysqli_query($conn, "CALL SEARCH_GALERIA('$GALLERY_NAME', '$ID')");
$result = mysqli_fetch_array($object);

if ($object->num_rows == 1) {
    $GALLERY_ID = $result[0];
    $object->close();
    $conn->next_result();
    mysqli_query($conn, "CALL INSERTAR_FOTO_EXHIBIR('$GALLERY_ID', '$PICTURE_ID')");
    $conn->next_result();
    header("Location: ../php/Sección_MisFotos.php");
} else {
    header("Location: ../php/Error_AgregarGaleria.php");
}

$conn->close();
?>