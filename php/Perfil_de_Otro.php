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

$USER_ID = $_POST['USER_ID'];
$object = mysqli_query($conn, "CALL GET_FOTOGRAFO_CON_ID('$USER_ID')");
$profile = mysqli_fetch_array($object);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Perfil de otro Usuario">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Perfil de <?php echo $profile[5] ?> </title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/Perfil_de_Otro_Stylesheet.css">

</head>

<body>
    <div class="background"></div>
    <header class="container-fluid d-flex justify-content-between align-items-center">
        <div id="logo">
            FOTOVERSO
        </div>
        <div id="buttons">
            <a href="../php/Sección_MisFotos.php" class="btn btn-outline-dark" style="margin-right: 15px; font-size:20px">Mis fotos</a>
            <a href="../php/Sección_Explorar.php" class="btn btn-outline-dark" style="margin-right: 15px; font-size:20px">Explorar</a>
            <a href="../php/Mi_Perfil.php" class="btn btn-outline-dark" style="margin-right: 15px; font-size:20px">Perfil</a>
            <a href="../php/Cerrar_Sesion.php" class="btn btn-outline-danger" style="margin-right: 15px; font-size:20px">Cerrar Sesion</a>
        </div>
    </header>
    <div class="rectangle">
        <div class="left-section">
            <div>
            <?php
                session_start();
                $object->close();
                $conn->next_result(); 
                $servername = "localhost"; // or the server address provided by your web host
                $username = "picify_db_editor"; // your database username
                $password = "#Ek11Mn35Gr06#"; // your database password
                $database = "picify_new_final_database"; // your database name

                $conn = new mysqli($servername, $username, $password, $database);

                if (mysqli_connect_error()) {
                    echo "No se pudo conectar a la Base de Datos";
                    die();
                }

                $USER_ID = $_POST['USER_ID'];
                $object = mysqli_query($conn, "CALL GET_FOTOGRAFO_CON_ID('$USER_ID')");
                $profile = mysqli_fetch_array($object);

                $NAME_OF_THE_USER = $profile[1];
                $SURNAME_OF_THE_USER = $profile[2];
                $EMAIL_OF_THE_USER = $profile[3];
                $PHONE_OF_THE_USER = $profile[4];
                $NICKNAME_OF_THE_USER = $profile[5];
                $object->close();
                $conn->next_result();

                $target_dir = "../profilePictures/";
                $result = mysqli_query($conn, "CALL GET_IMG_PERFIL('$NAME_OF_THE_USER', '$SURNAME_OF_THE_USER', '$EMAIL_OF_THE_USER', '$NICKNAME_OF_THE_USER')"); // La QUERY devuelve un objeto
                //while($img_name = mysqli_fetch_array($result)) {
                    //echo $img_name['IMG_Perfil']; // Print a single column data
                    //echo print_r($img_name);       // Print the entire row data
                // } 
                
                $img_name = mysqli_fetch_array($result);
                $target_file = $target_dir . $img_name['IMG_Perfil'];

                echo "<p class='info' style='text-shadow: 0px 0px 6px rgba(255,255,255,0.7);'> <u style='text-decoration: none'>Perfil de</u> {$NICKNAME_OF_THE_USER} </p>";
                if ($target_file != $target_dir) {
                    echo "<img id='profile-image' src='{$target_file}' alt='Imagen de perfil' style='border: 5px rgba(255,255,255,0.7) solid;'>";
                } else {
                    echo "<img id='profile-image' src='Perfil.png' alt='Imagen de perfil' style='border: 5px rgba(255,255,255,0.7) solid;'>";
                }
                ?>
            </div>
            <p class="info"> <u style="text-shadow: 0px 0px 6px rgba(255,255,255,0.7);">Nombre de Usuario:</u> <?php echo $NICKNAME_OF_THE_USER; ?> </p>
            <p class="info"> <u style="text-shadow: 0px 0px 6px rgba(255,255,255,0.7);">Nombre y Apellido:</u> <?php echo $NAME_OF_THE_USER; ?> <?php echo $SURNAME_OF_THE_USER; ?> </p>
            <p class="info"> <u style="text-shadow: 0px 0px 6px rgba(255,255,255,0.7);">Email:</u> <?php echo $EMAIL_OF_THE_USER; ?> </p>
            <p class="info"> <u style="text-shadow: 0px 0px 6px rgba(255,255,255,0.7);">Telefono:</u> 
                <?php echo $PHONE_OF_THE_USER ?> 
            </p>

            <div>
                <form action="../php/Busqueda_Filtrada.php" method="POST" enctype="multipart/form-data">
                    <table style="text-align: center">
                    <div style="text-align: justify;">
                        <div style="float: right; margin-right: 60px">
                            <input type="hidden" id="Ascendente "name="order" value="Ascendente"> 
                            <input type="hidden" id="Descendente" name="order" value="Descendente"> 
                        </div>
                    </div>
                    <tr>
                        <td> <input type="hidden" name="name" value="<?php echo $NICKNAME_OF_THE_USER?>" required> </td>
                    </tr>
                    </table>
                    <tr>
                        <td> <input type="hidden" name="category"> </td>
                    </tr>
                    <div style="margin-top: 5px; font-size: 20px; text-align: center;">
                        <tr>
                        <td> <input type="submit" class='btn btn-outline-dark' style='background: #9ab7b7' value="Ver Fotos de este Usuario!"> </td>
                        </tr>
                    </div>
                </form>
            </div>

            <div>
                <form action="../php/Busqueda_Filtrada_Galerias.php" method="POST" enctype="multipart/form-data">
                <table style="text-align: center;">
                    <tr>
                        <td> <input type="hidden" name="name" value="<?php echo $NICKNAME_OF_THE_USER?>" required> </td>
                    </tr>
                    <tr>
                        <td> <input type="hidden" name="gallery"> </td>
                    </tr>
                    <tr>
                        <td> <input type="hidden" name="price"> </td>
                    </tr>
                    </table>
                    <div style="margin-top: 5px; font-size: 20px; text-align: center;">
                        <tr>
                            <td> <input type="submit" class='btn btn-outline-dark' style='background: #9ab7b7' value="Ver Galerias de este Usuario!"> </td>
                        </tr>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>