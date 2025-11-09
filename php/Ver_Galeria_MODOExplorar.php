<?php
session_start();
$OWNER_ID_TOO = $_POST['owner_id'];
$GALLERY_ID = $_POST['internal_id'];

$servername = "localhost"; // or the server address provided by your web host
$username = "picify_db_editor"; // your database username
$password = "#Ek11Mn35Gr06#"; // your database password
$database = "picify_new_final_database"; // your database name

$conn = new mysqli($servername, $username, $password, $database);

if (mysqli_connect_error()) {
    echo "No se pudo conectar a la Base de Datos";
    die();
}

$object = mysqli_query($conn, "CALL GET_GALERIA('$GALLERY_ID')");
$result = mysqli_fetch_array($object);
$stored_gallery_name = $result[2];
$object->close();
$conn->next_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Ver Galeria">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - <?php echo $stored_gallery_name ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/Seccion_Explorar.css">
</head>
<body>
    <div class="background"></div>
    <header class="container-fluid d-flex justify-content-between align-items-center">
        <div id="logo">
            FOTOVERSO
        </div>
        <div style="display: flex; align-items: center">
            <div id="buttons" style="flex: 10">
                <a href="../php/Sección_MisFotos.php" class="btn btn-outline-dark" style="margin-right: 15px; font-size:20px">Mis fotos</a>
                <a href="../php/Sección_Explorar.php" class="btn btn-outline-dark" style="margin-right: 15px; font-size:20px">Explorar</a>
                <a href="../php/Mi_Perfil.php" class="btn btn-outline-dark" style="margin-right: 15px; font-size:20px">Perfil</a>
                <a href="../php/Cerrar_Sesion.php" class="btn btn-outline-danger" style="margin-right: 15px; font-size:20px">Cerrar Sesion</a>
            </div>
            <div style="flex: 1">
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

                $target_dir = "../profilePictures/";
                $result = mysqli_query($conn, "CALL GET_IMG_PERFIL('$Nombre', '$Apellido', '$Email', '$Nickname')"); // La QUERY devuelve un objeto
                //while($img_name = mysqli_fetch_array($result)) {
                    //echo $img_name['IMG_Perfil']; // Print a single column data
                    //echo print_r($img_name);       // Print the entire row data
                // } 
                
                $img_name = mysqli_fetch_array($result);
                $target_file = $target_dir . $img_name['IMG_Perfil'];

                if ($target_file != $target_dir) {
                    echo "<img id='profile-image' src='{$target_file}' alt='Imagen de Perfil' style='border: 5px rgba(255,255,255,0.7) solid; max-width: 100px; max-height: 65px'>";
                } else {
                    echo "<img id='profile-image' src='../img/Perfil.png' alt='Imagen de Perfil' style='border: 5px rgba(255,255,255,0.7) solid; max-width: 100px; max-height: 65px'>";
                }
                $conn->next_result();
                ?>
                <p class="info" style="text-shadow: 0px 0px 6px rgba(255,255,255,0.7);"> <?php echo $_SESSION['account_nickname'] ?> </p>
            </div>
        </div>
    </header>

    <div class="rectangle">
        <div class="left-section">
            <div style="min-width: 106.91px">
            <p style="font-size: x-large; margin-bottom: 5px"> Viendo la Galeria de </p>
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

                $object = mysqli_query($conn, "CALL GET_FOTOGRAFO_CON_ID('$OWNER_ID_TOO')");
                $result = mysqli_fetch_array($object);

                $Nombre = $result['Nombre'];
                $Apellido = $result['Apellido'];
                $Email = $result['Email'];
                $Nickname = $result['Nickname'];
                $object->close();
                $conn->next_result();

                $target_dir = "../profilePictures/";
                $result = mysqli_query($conn, "CALL GET_IMG_PERFIL('$Nombre', '$Apellido', '$Email', '$Nickname')"); // La QUERY devuelve un objeto
                //while($img_name = mysqli_fetch_array($result)) {
                    //echo $img_name['IMG_Perfil']; // Print a single column data
                    //echo print_r($img_name);       // Print the entire row data
                // } 
                
                $img_name = mysqli_fetch_array($result);
                $target_file = $target_dir . $img_name['IMG_Perfil'];

                if ($target_file != $target_dir) {
                    echo "<img id='profile-image' src='{$target_file}' alt='Imagen de Perfil' style='border: 5px rgba(255,255,255,0.7) solid';>";
                } else {
                    echo "<img id='profile-image' src='../img/Perfil.png' alt='Imagen de Perfil' style='border: 5px rgba(255,255,255,0.7) solid'>";
                }
                echo $Nickname;
                ?>
            </div>
            <p class="info" style="text-shadow: 0px 0px 6px rgba(255,255,255,0.7); margin-top: 10px; text-decoration: underline"> Llamada </p>
            <?php 
                $servername = "localhost"; // or the server address provided by your web host
                $username = "picify_db_editor"; // your database username
                $password = "#Ek11Mn35Gr06#"; // your database password
                $database = "picify_new_final_database"; // your database name

                $conn = new mysqli($servername, $username, $password, $database);

                if (mysqli_connect_error()) {
                    echo "No se pudo conectar a la Base de Datos";
                    die();
                }
                
                $object = mysqli_query($conn, "CALL GET_GALERIA('$GALLERY_ID')");
                $result = mysqli_fetch_array($object);
                echo $result['Nombre'];
                $object->close();
                $conn->next_result();

                $object = mysqli_query($conn, "CALL GET_FOTOGRAFO_CON_ID('$OWNER_ID_TOO')");
                $result = mysqli_fetch_array($object);

                $Nombre = $result['Nombre'];
                $Apellido = $result['Apellido'];
                $Email = $result['Email'];
                $Nickname = $result['Nickname'];
                $object->close();
                $conn->next_result();

                echo "
                <div>
                <form action='../php/Perfil_de_Otro.php' method='POST'>
                    <input type='hidden' name='USER_ID' value='{$OWNER_ID_TOO}'>
                    <input type='submit' class='btn btn-outline-dark' style='background: #9ab7b7' value='Visitar el Perfil de {$Nickname}' style='margin-top: 10px; font-size: medium'>
                </form>
                </div> 
                "
            ?>
        </div>

     <div class="container-fluid">
      <div class="row">
        <div class="right-container">
            <div class="right-section"> 
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

                $object = mysqli_query($conn, "CALL GET_FOTOS_DE_UNA_GALERIA('$GALLERY_ID')");
                $TEMP_STORAGE_ID_FOTOS = mysqli_fetch_all($object, MYSQLI_ASSOC);
                $object->close();
                $conn->next_result();
                
                foreach($TEMP_STORAGE_ID_FOTOS as $fotos) {
                    $SEND_THIS = $fotos['ID_Foto'];
                    $object = mysqli_query($conn, "CALL GET_FOTO_CON_ID('$SEND_THIS')");
                    $TEMP_STORAGE_FOTOS = mysqli_fetch_array($object);

                    $target_dir = "../uploadedPictures/";
                    $target_file = $target_dir . $TEMP_STORAGE_FOTOS['Nombre'];
                    $object->close();
                    $conn->next_result();

                    $category_id = $TEMP_STORAGE_FOTOS['ID_Categoria'];
                    $object = mysqli_query($conn, "CALL SEARCH_FOR_CATEGORIA_ID('$category_id')");
                    $result = mysqli_fetch_array($object);

                    $lat = $TEMP_STORAGE_FOTOS['Latitud'];
                    $lon = $TEMP_STORAGE_FOTOS['Longitud'];

                    if ($lat != 0 and $lon != 0) {
                        $geocode = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lon}&sensor=false&key=AIzaSyAb9E_u29AMlQJ9awer7S_YXYP2Ue9SEow");
                        $output = json_decode($geocode);
                        
                        if ($output && $output->status === "OK" && !empty($output->results)) {
                            $city = $country = "Not found";
                        
                            foreach ($output->results as $r) {
                                foreach ($r->address_components as $n) {
                                    if (isset($n->types[0]) && $n->types[0] === "locality" && isset($n->types[1]) && $n->types[1] === "political") {
                                        $city = $n->long_name;
                                    }
                        
                                    if (isset($n->types[0]) && $n->types[0] === "country" && isset($n->types[1]) && $n->types[1] === "political") {
                                        $country = $n->long_name;
                                    }
                                }
                            }

                            $formattedAddress = $output->results[0]->formatted_address;
                        } 
                        else 
                        {
                            $city = "Not found";
                            $country = "Not found";
                            $formattedAddress = "Not found";
                        }

                        $lat = trim($lat);
                        $lon = trim($lon);
                        $mapsUrl = "https://www.google.com/maps/search/?api=1&query={$lat},{$lon}";
                    echo "
                    <div class='col'>
                        <img class='square-image' src='{$target_file}' alt='Imagen' style='border: 5px rgba(255,255,255,0.7) solid'>
                        <div>
                            <p> <u style='text-decoration: underline'>ID Interno:</u> {$TEMP_STORAGE_FOTOS['ID']} <br> 
                            <u style='text-decoration: underline'>Usuario:</u> {$result['Nombre']} <br> 
                            <u style='text-decoration: underline'>Fecha:</u> {$TEMP_STORAGE_FOTOS['Fecha']} <br> 
                            <u style='text-decoration: underline'>Descripcion:</u> {$TEMP_STORAGE_FOTOS['Descripcion']} <br>
                            <u style='text-decoration: underline'>LAT y LON:</u> {$lat}, {$lon} <br>
                            <u style='text-decoration: underline'>Pais:</u> {$country} <br> 
                            <u style='text-decoration: underline'>Ciudad:</u> {$city} <br>
                            <u style='text-decoration: underline'>Direccion:</u> {$formattedAddress} </p>
                        </div>
                        <a href='$mapsUrl' target='_blank' class='btn btn-outline-dark' style='background: #9ab7b7; margin: 5px; letter-spacing: 0px'>VER EN MAPA</a>
                    </div>";
                    }
                    else 
                    {
                        echo "
                        <div class='col'>
                            <img class='square-image' src='{$target_file}' alt='Imagen' style='border: 5px rgba(255,255,255,0.7) solid'>
                            <div>
                                <p> <u style='text-decoration: underline'>ID Interno:</u> {$TEMP_STORAGE_FOTOS['ID']} <br> <u style='text-decoration: underline'>Usuario:</u> {$result['Nombre']} <br> <u style='text-decoration: underline'>Fecha:</u> {$TEMP_STORAGE_FOTOS['Fecha']} <br> <u style='text-decoration: underline'>Descripcion:</u> {$TEMP_STORAGE_FOTOS['Descripcion']} </p>
                            </div>
                        </div>";
                    }
                    $object->close();
                    $conn->next_result();
                }
                ?>
            </div>
        </div>
      </div>
     </div>
    </div>
</body>
</html>