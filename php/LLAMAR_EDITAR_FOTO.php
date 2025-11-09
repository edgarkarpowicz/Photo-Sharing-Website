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

$internal_id = $_POST['id'];
$new_date = $_POST['date'];
$new_desc = $_POST['description'];
$category = $_POST['category'];

// echo $target_dir; // Directorio donde se va a guardar la IMG 
// echo $target_file; // Directorio Completo 
// echo $_FILES["fileToUpload"]["name"]; // Nombre del Archivo
// echo $uploadOk; // Si esta bien para subir -- Secundario -- Para hacer checkeos como si el Archivo Existe, Si es una Imágen, Para Limitar el Tamaño del Archivo, Solo permitir ciertos Formatos de Imagen, etc. 
// echo $imageFileType; // Tipo del Archivo. PNG, JPG, etc.

// $object = mysqli_query($conn, "CALL GET_ID('$Nombre', '$Apellido', '$Email', '$Nickname')");
// $result = mysqli_fetch_array($object);
// $ID = $result['ID'];
// $object->close();
// $conn->next_result();

$owner = $_SESSION['account_nickname'];

if (!empty($new_date) && !empty($new_desc)) {
    mysqli_query($conn, "CALL FOTOS_UPDATE_FECHA('$new_date', '$owner', '$internal_id')");
    $conn->next_result();
    mysqli_query($conn, "CALL FOTOS_UPDATE_DESC('$new_desc', '$owner', '$internal_id')");
} else if (!empty($new_date) && empty($new_desc)) {
    mysqli_query($conn, "CALL FOTOS_UPDATE_FECHA('$new_date', '$owner', '$internal_id')");
    $conn->next_result();
} else if (empty($new_date) && !empty($new_desc)) {
    mysqli_query($conn, "CALL FOTOS_UPDATE_DESC('$new_desc', '$owner', '$internal_id')");
    $conn->next_result();
}

if (!empty($category)) {
    $object = mysqli_query($conn, "CALL SEARCH_FOR_CATEGORIA('$category')");
    if ($object->num_rows >= 1) {
        $result = mysqli_fetch_array($object);
        $NEW_CATEGORY_ID = $result['ID'];
        $object->close();
        $conn->next_result();
        mysqli_query($conn, "CALL FOTOS_UPDATE_CATEGORIA('$NEW_CATEGORY_ID', '$internal_id', '$owner')");
        $conn->next_result();
    } else {
        $object->close();
        $conn->next_result();
        mysqli_query($conn, "CALL INSERTAR_CATEGORIA('$category')");
        $conn->next_result();
        $object = mysqli_query($conn, "CALL SEARCH_FOR_CATEGORIA('$category')");
        $result = mysqli_fetch_array($object);
        $NEW_CATEGORY_ID = $result['ID'];
        $object->close();
        $conn->next_result();
        mysqli_query($conn, "CALL FOTOS_UPDATE_CATEGORIA('$NEW_CATEGORY_ID', '$internal_id', '$owner')");
        $conn->next_result();
    }
}

header("Location: ../php/Sección_MisFotos.php");
$conn->close();
?>