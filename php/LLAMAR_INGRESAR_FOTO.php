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
$filename = $_FILES["fileToUpload"]["name"];
$category = $_POST['category'];

$target_dir = "../uploadedPictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// echo $target_dir; // Directorio donde se va a guardar la IMG 
// echo $target_file; // Directorio Completo 
// echo $_FILES["fileToUpload"]["name"]; // Nombre del Archivo
// echo $uploadOk; // Si esta bien para subir -- Secundario -- Para hacer checkeos como si el Archivo Existe, Si es una Imágen, Para Limitar el Tamaño del Archivo, Solo permitir ciertos Formatos de Imagen, etc. 
// echo $imageFileType; // Tipo del Archivo. PNG, JPG, etc.

// POR SI ACASO, VIEJA IMPLEMENTACIÓN CON ID 12-11-24 //
// $object = mysqli_query($conn, "CALL GET_ID('$Nombre', '$Apellido', '$Email', '$Nickname')");
// $result = mysqli_fetch_array($object);
// $ID = $result['ID'];
// $object->close();
// $conn->next_result();

if (file_exists($target_file) or ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")) {
    header("Location: ../php/Error_Ingreso_Foto.php");
    die();
}

$object = mysqli_query($conn, "CALL SEARCH_FOR_CATEGORIA('$category')");
if ($object->num_rows >= 1) {
    $result = mysqli_fetch_array($object);
    $CATEGORY_ID = $result['ID'];
    $object->close();
    $conn->next_result();
} else {
    $object->close();
    $conn->next_result();
    mysqli_query($conn, "CALL INSERTAR_CATEGORIA('$category')");
    $conn->next_result();
    $object = mysqli_query($conn, "CALL SEARCH_FOR_CATEGORIA('$category')");
    $result = mysqli_fetch_array($object);
    $CATEGORY_ID = $result['ID'];
    $conn->next_result();
}

$owner = $_SESSION['account_nickname'];

function get_image_location($image = ''){
    $exif = exif_read_data($image, 0, true);
    if($exif && isset($exif['GPS'])){
        $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
        $GPSLatitude    = $exif['GPS']['GPSLatitude'];
        $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
        $GPSLongitude   = $exif['GPS']['GPSLongitude'];
        
        $lat_degrees = count($GPSLatitude) > 0 ? gps2Num($GPSLatitude[0]) : 0;
        $lat_minutes = count($GPSLatitude) > 1 ? gps2Num($GPSLatitude[1]) : 0;
        $lat_seconds = count($GPSLatitude) > 2 ? gps2Num($GPSLatitude[2]) : 0;
        
        $lon_degrees = count($GPSLongitude) > 0 ? gps2Num($GPSLongitude[0]) : 0;
        $lon_minutes = count($GPSLongitude) > 1 ? gps2Num($GPSLongitude[1]) : 0;
        $lon_seconds = count($GPSLongitude) > 2 ? gps2Num($GPSLongitude[2]) : 0;
        
        $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
        $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;
        
        $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
        $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));

        return array('latitude'=>$latitude, 'longitude'=>$longitude);
    }else{
        return false;
    }
}

function gps2Num($coordPart){
    $parts = explode('/', $coordPart);
    if(count($parts) <= 0)
    return 0;
    if(count($parts) == 1)
    return $parts[0];
    return floatval($parts[0]) / floatval($parts[1]);
}

if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
    // echo "<h3> Imágen subida con exito! </h3>";
} else {
    // echo "<h3> Imágen no subida! </h3>";
}

$imgLocation = get_image_location($target_file);

if ($imgLocation != false) 
{
    $lat = $imgLocation['latitude'];
    $lon = $imgLocation['longitude'];
} else 
{
    $lat = 0;
    $lon = 0;
}

$geocode = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lon}&sensor=false&key=AIzaSyAb9E_u29AMlQJ9awer7S_YXYP2Ue9SEow");
$output = json_decode($geocode);

if ($output && $output->status === "OK" && !empty($output->results)) {
    $country = "Not found";

    foreach ($output->results as $r) {
        foreach ($r->address_components as $n) {
            if (isset($n->types[0]) && $n->types[0] === "country" && isset($n->types[1]) && $n->types[1] === "political") {
                $country = $n->long_name;
            }
        }
    }
} 
else 
{
    $country = "Not found";
}

$finalID = mysqli_query($conn, "CALL GET_FOTOGRAFO_CON_OWNER('$owner')");
$finalIDStorage = mysqli_fetch_array($finalID);
$conn->next_result();

$ownerID = $finalIDStorage[0];

$another = mysqli_query($conn, "CALL INSERTAR_FOTO('$date', '$desc', '$filename', '$owner', '$CATEGORY_ID', '$lat', '$lon', '$country', '$ownerID')");
header("Location: ../php/Sección_MisFotos.php");
$conn->close();
?>