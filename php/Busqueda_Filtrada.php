<?php
session_start();
$servername = "localhost"; // or the server address provided by your web host
$username = "picify_db_editor"; // your database username
$password = "#Ek11Mn35Gr06#"; // your database password
$database = "picify_new_final_database"; // your database name

$conn = new mysqli($servername, $username, $password, $database);

$SEARCH_ORDER = $_POST['order'];
$SEARCH_USER = $_POST['name'];
$SEARCH_CATEGORY = $_POST['category'];

if (empty($SEARCH_ORDER) && empty($SEARCH_USER) && empty($SEARCH_CATEGORY)) {
    header("Location: ../php/error_busqueda_filtrada.php");
    die();
}

if (!empty($SEARCH_USER)) {
    $object = mysqli_query($conn, "CALL CHECK_NICKNAME('$SEARCH_USER')");
    if ($object->num_rows == 0) {
        header("Location: ../php/error_busqueda_filtrada.php");
    } else {
        $result = mysqli_fetch_array($object);
        $USER_ID = $result[0];
    }
    $object->close();
    $conn->next_result();
}

if (!empty($SEARCH_CATEGORY)) {
    $object = mysqli_query($conn, "CALL SEARCH_FOR_CATEGORIA('$SEARCH_CATEGORY')");
    if ($object->num_rows == 0) {
        header("Location: ../php/error_busqueda_filtrada.php");
    } else {
        $result = mysqli_fetch_array($object);
        $CATEGORY_ID = $result[0];
    }
    $object->close();
    $conn->next_result();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Busqueda Filtrada de Fotos">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Busqueda Filtrada de Fotos</title>
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
        <p class="info" style="text-shadow: 4px 3px 0px rgba(171, 183, 183, 1), 9px 8px 0px rgba(0,0,0,0.15); font-size: xxx-large"> BUSQUEDA EXPLORAR (FOTOS) </p>
            <a href="../php/Sección_Explorar.php" class="btn btn-outline-dark" style="margin-top: 5px; font-size: 24px; background: #9ab7b7"> Retornar </a>
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

                if (!empty($SEARCH_ORDER)) {
                    if ($SEARCH_ORDER == "Ascendente") {
                        if (!empty($SEARCH_USER) && !empty($SEARCH_CATEGORY)) {
                            $object = mysqli_query($conn, "CALL FOTOS_ASCconUSERyCATEGORY('$SEARCH_USER', '$CATEGORY_ID')");
                        } else if (!empty($SEARCH_USER) && empty($SEARCH_CATEGORY)) {
                            $object = mysqli_query($conn, "CALL FOTOS_ASCconUSER('$SEARCH_USER')");
                        } else if (empty($SEARCH_USER) && !empty($SEARCH_CATEGORY)) {
                            $object = mysqli_query($conn, "CALL FOTOS_ASCconCATEGORY('$CATEGORY_ID')");
                        } else {
                            $object = mysqli_query($conn, "CALL FOTOS_ASC()");
                        }
                    } else if ($SEARCH_ORDER == "Descendente") {
                        if (!empty($SEARCH_USER) && !empty($SEARCH_CATEGORY)) {
                            $object = mysqli_query($conn, "CALL FOTOS_DESconUSERyCATEGORY('$SEARCH_USER', '$CATEGORY_ID')");
                        } else if (!empty($SEARCH_USER) && empty($SEARCH_CATEGORY)) {
                            $object = mysqli_query($conn, "CALL FOTOS_DESconUSER('$SEARCH_USER')");
                        } else if (empty($SEARCH_USER) && !empty($SEARCH_CATEGORY)) {
                            $object = mysqli_query($conn, "CALL FOTOS_DESconCATEGORY('$CATEGORY_ID')");
                        } else {
                            $object = mysqli_query($conn, "CALL FOTOS_DES()");
                        }
                    }
                } else {
                    if (!empty($SEARCH_USER) && !empty($SEARCH_CATEGORY)) {
                        $object = mysqli_query($conn, "CALL FOTOS_USERyCATEGORY('$SEARCH_USER', '$CATEGORY_ID')");
                    } else if (!empty($SEARCH_USER) && empty($SEARCH_CATEGORY)) {
                        $object = mysqli_query($conn, "CALL FOTOS_USER('$SEARCH_USER')");
                    } else if (empty($SEARCH_USER) && !empty($SEARCH_CATEGORY)) {
                        $object = mysqli_query($conn, "CALL FOTOS_CATEGORY('$CATEGORY_ID')");
                    }
                }

                $TEMP_STORAGE_FOTOS = mysqli_fetch_all($object, MYSQLI_ASSOC);
                $object->close();
                $conn->next_result();

                foreach ($TEMP_STORAGE_FOTOS as $fotos) {
                    $category_id = $fotos['ID_Categoria'];
                    $object = mysqli_query($conn, "CALL SEARCH_FOR_CATEGORIA_ID('$category_id')");
                    $result = mysqli_fetch_array($object);
                    $TEMP_STORAGE_CATEGORIA = $result[1];
                    $object->close();
                    $conn->next_result();

                    $TEMP_OWNER = $fotos['Owner'];
                    $object = mysqli_query($conn, "CALL GET_FOTOGRAFO_CON_OWNER('$TEMP_OWNER')");
                    $profile = mysqli_fetch_array($object);
                    $target_dir_profiles = "../profilePictures/";
                    $target_file_profiles = $target_dir_profiles . $profile[6];

                    if ($target_dir_profiles == $target_file_profiles) {
                        $target_file_profiles = "../img/Perfil.png";
                    }

                    $target_dir = "../uploadedPictures/";;
                    $target_file = $target_dir . $fotos['Nombre'];

                    $lat = $fotos['Latitud'];
                    $lon = $fotos['Longitud'];

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
                    <div class='image-info'>
                        <div class='imageInfo-left'>
                        <p> <u style='text-decoration: underline'>Usuario:</u> {$profile[5]} <br> 
                        <u style='text-decoration: underline'>Categoria:</u> {$TEMP_STORAGE_CATEGORIA} <br> 
                        <u style='text-decoration: underline'>Fecha:</u> {$fotos['Fecha']} <br> 
                        <u style='text-decoration: underline'>Descripcion:</u> {$fotos['Descripcion']} <br>
                        <u style='text-decoration: underline'>LAT y LON:</u> {$lat}, {$lon} <br>
                        <u style='text-decoration: underline'>Pais:</u> {$country} <br> 
                        <u style='text-decoration: underline'>Ciudad:</u> {$city} <br> 
                        <u style='text-decoration: underline'>Direccion:</u> {$formattedAddress} </p>
                        </div>
                        <div class='imageInfo-right'>
                            <img class='small-profile-image' src='{$target_file_profiles}' style='border: 5px rgba(255,255,255,0.7) solid'>
                        </div>
                    </div>
                    <a href='$mapsUrl' target='_blank' class='btn btn-outline-dark' style='background: #9ab7b7; margin: 5px; letter-spacing: 0px'>VER EN MAPA</a>
                    <form action='../php/Perfil_de_Otro.php' method='POST'>
                        <input type='hidden' name='USER_ID' value='{$profile['ID']}'>
                        <input type='submit' class='btn btn-outline-dark' style='background: #9ab7b7' value='Visitar el Perfil de {$profile[5]}'>
                    </form>
                    </div>";
                    }
                    else 
                    {
                        echo "
                        <div class='col'>
                        <img class='square-image' src='{$target_file}' alt='Imagen' style='border: 5px rgba(255,255,255,0.7) solid'>
                        <div class='image-info'>
                            <div class='imageInfo-left'>
                            <p> <u style='text-decoration: underline'>Usuario:</u> {$profile[5]} <br> <u style='text-decoration: underline'>Categoria:</u> {$TEMP_STORAGE_CATEGORIA} <br> <u style='text-decoration: underline'>Fecha:</u> {$fotos['Fecha']} <br> <u style='text-decoration: underline'>Descripcion:</u> {$fotos['Descripcion']} </p>
                            </div>
                            <div class='imageInfo-right'>
                                <img class='small-profile-image' src='{$target_file_profiles}' style='border: 5px rgba(255,255,255,0.7) solid'>
                            </div>
                        </div>
                        <form action='../php/Perfil_de_Otro.php' method='POST'>
                            <input type='hidden' name='USER_ID' value='{$profile['ID']}'>
                            <input type='submit' class='btn btn-outline-dark' style='background: #9ab7b7' value='Visitar el Perfil de {$profile[5]}'>
                        </form>
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