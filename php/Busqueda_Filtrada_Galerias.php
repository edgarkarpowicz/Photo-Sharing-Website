<?php
session_start();
$servername = "localhost"; // or the server address provided by your web host
$username = "picify_db_editor"; // your database username
$password = "#Ek11Mn35Gr06#"; // your database password
$database = "picify_new_final_database"; // your database name

$conn = new mysqli($servername, $username, $password, $database);

$SEARCH_USER = $_POST['name'];
$SEARCH_GALLERY = $_POST['gallery'];

if (empty($SEARCH_USER) && empty($SEARCH_GALLERY)) {
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
    $object = mysqli_query($conn, "CALL SEARCH_GALERIA_NAME('$SEARCH_GALLERY')");
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
    <meta name="description" content="Fotoverso - Busqueda Filtrada de Galerias">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Busqueda Filtrada de Galerias</title>
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
        <p class="info" style="text-shadow: 4px 3px 0px rgba(171, 183, 183, 1), 9px 8px 0px rgba(0,0,0,0.15); font-size: xxx-large"> BUSQUEDA EXPLORAR (GALERIAS) </p>
            <a href="../php/Ver_Galerias.php" class="btn btn-outline-dark" style="margin-top: 5px; font-size: 24px; background: #9ab7b7"> Retornar </a>
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

                $object = mysqli_query($conn, "CALL LISTAR_GALERIAS()");
                $TEMP_STORAGE_GALERIAS = mysqli_fetch_all($object, MYSQLI_ASSOC);
                $object->close();
                $conn->next_result();

                foreach($TEMP_STORAGE_GALERIAS as $galerias) {
                    $target_dir = "../galleryPictures/";
                    $target_file = $target_dir . $galerias['IMG_Portada'];

                    $ID_OWNER = $galerias['ID_Propietario'];
                    $object = mysqli_query($conn, "CALL GET_FOTOGRAFO_CON_ID('$ID_OWNER')");
                    $result = mysqli_fetch_array($object);
                    $NAME_OWNER = $result[5];

                    $target_dir_profiles = "../profilePictures/";
                    $target_file_profiles = $target_dir_profiles . $result[7];

                    if ($target_dir_profiles == $target_file_profiles) {
                        $target_file_profiles = "../img/Perfil.png";
                    }

                    $object->close();
                    $conn->next_result();

                    if (!empty($SEARCH_USER) or !empty($SEARCH_GALLERY)) {
                        if (!empty($SEARCH_USER) && $NAME_OWNER != $SEARCH_USER) {
                            continue;
                        } else if (!empty($SEARCH_GALLERY) && $galerias['Nombre'] != $SEARCH_GALLERY) {
                            continue;
                        }
                    } 

                    echo "
                    <div class='row'>
                    <div class='col-lg-12'>
                        <div class='rectangle' style='border: 5px rgba(255,255,255,0.7) solid; margin-bottom: 5px'>
                            <div class='row'>
                                <div class='col-lg-2' style='border-right: 5px rgba(255,255,255,0.7) solid;'>
                                    <p><u>Nombre de Galeria:</u> {$galerias['Nombre']}</p>
                                </div>
                                <div class='col-lg-2' style='border-right: 5px rgba(255,255,255,0.7) solid;'>
                                    <p><u>Usuario:</u> {$result[5]}</p>
                                </div>
                                <div class='col-lg-2' style='border-right: 5px rgba(255,255,255,0.7) solid;'>
                                    <p><u>Descripcion:</u> {$galerias['Descripcion']}</p>
                                </div>
                                <div class='col-lg-4'>
                                    <form action='../php/Ver_Galeria_MODOExplorar.php' method='POST' style='margin-top: 5px; margin-bottom: 5px'>
                                        <input type='hidden' name='owner_id' value='{$ID_OWNER}'> 
                                        <input type='hidden' name='internal_id' value='{$galerias['ID']}'>
                                        <input type='submit' class='btn btn-outline-dark' style='background: #9ab7b7' value='VER ESTA GALERIA'>
                                    </form>
                                    <form action='../php/Perfil_de_Otro.php' method='POST'>
                                        <input type='hidden' name='USER_ID' value='{$ID_OWNER}'>
                                        <input type='submit' class='btn btn-outline-dark' style='background: #9ab7b7' value='Visitar el Perfil de {$NAME_OWNER}'>
                                    </form>
                                    <img class='square-image' src='{$target_file}' alt='Imagen' style='border: 5px rgba(255,255,255,0.7) solid; max-height: 75px; max-width: 75px; margin-top: 10px'>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>";
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