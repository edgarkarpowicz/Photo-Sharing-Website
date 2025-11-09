<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Mi Perfil">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Mi Perfil</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/Mi_Perfil_Stylesheet.css">
</head>

<body>
    <div class="background"></div>
    <header class="container-fluid d-flex justify-content-between align-items-center">
        <div id="logo">FOTOVERSO</div>
        <div id="buttons">
            <a href="../php/Sección_MisFotos.php" class="btn btn-outline-dark">Mis fotos</a>
            <a href="../php/Sección_Explorar.php" class="btn btn-outline-dark">Explorar</a>
            <a href="../php/Mi_Perfil.php"class="btn btn-outline-dark">Perfil</a>
            <a href="../php/Cerrar_Sesion.php"class="btn btn-danger">Cerrar Sesion</a>
        </div>
    </header>

    <main>
        <section class="profile-section container-fluid">
            <div class="row">
                <!-- Left Profile Section -->
                <div class="col-md-4">
                    <div class="left-section">
                        <div class="profile-image-container">
                            <?php
                                $servername = "localhost"; 
                                $username = "picify_db_editor"; 
                                $password = "#Ek11Mn35Gr06#"; 
                                $database = "picify_new_final_database"; 

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
                                $result = mysqli_query($conn, "CALL GET_IMG_PERFIL('$Nombre', '$Apellido', '$Email', '$Nickname')");
                                $img_name = mysqli_fetch_array($result);
                                $target_file = $target_dir . $img_name['IMG_Perfil'];

                                if ($target_file != $target_dir) {
                                    echo "<img id='profile-image' src='{$target_file}' alt='Imagen de perfil'>";
                                } else {
                                    echo "<img id='profile-image' src='../img/Perfil.png' alt='Imagen de perfil'>";
                                }
                            ?>
                        </div>
                        <div class="profile-info">
                            <p class="info"> <u style="font-weight: bold">Nombre de Usuario:</u> <?php echo $_SESSION['account_nickname'] ?> </p>
                            <p class="info"> <u style="font-weight: bold">Nombre y Apellido:</u> <?php echo $_SESSION['account_name'] ?> <?php echo $_SESSION['account_surname'] ?> </p>
                            <p class="info"> <u style="font-weight: bold">Email:</u> <?php echo $_SESSION['account_email'] ?> </p>
                            <p class="info"> <u style="font-weight: bold">Teléfono:</u> 
                                <?php 
                                $servername = "localhost"; 
                                $username = "picify_db_editor"; 
                                $password = "#Ek11Mn35Gr06#"; 
                                $database = "picify_new_final_database"; 
                                
                                $conn = new mysqli($servername, $username, $password, $database);
                                
                                if (mysqli_connect_error()) {
                                    echo "No se pudo conectar a la Base de Datos";
                                    die();
                                }
                                
                                $OBJETO = mysqli_query($conn, "CALL GET_TELEFONO('$Nombre', '$Apellido', '$Email', '$Nickname')");
                                $TEL = mysqli_fetch_array($OBJETO);
                                echo $TEL['Telefono'];
                                ?> 
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Profile Editing Section -->
                <div class="col-md-8">
                    <div class="right-container">
                        <div class="buttons-container">
                            <form action="../php/LLAMAR_CAMBIAR_NICKNAME.php" method="post" class="edit-form">
                                <label>Editar Nickname:</label>
                                <input type="text" name="nickname" required>
                                <button type="submit" style="font-weight: bold">Cambiar Nickname</button>
                            </form>

                            <form action="../php/LLAMAR_CAMBIAR_EMAIL.php" method="post" class="edit-form">
                                <label>Editar Email:</label>
                                <input type="text" name="email" required>
                                <button type="submit" style="font-weight: bold">Cambiar Email</button>
                            </form>

                            <form action="../php/LLAMAR_CAMBIAR_TELEFONO.php" method="post" class="edit-form">
                                <label>Editar Teléfono:</label>
                                <input type="tel" name="phone" required>
                                <button type="submit" style="font-weight: bold">Cambiar Teléfono</button>
                            </form>

                            <form action="../php/LLAMAR_NUEVA_IMG_PERFIL.php" method="post" enctype="multipart/form-data" class="edit-form">
                                <label>Cambiar Foto de Perfil:</label>
                                <input type="file" name="fileToUpload" id="fileToUpload" style="color: white">
                                <button type="submit" name="submit" style="font-weight: bold">Subir Foto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>