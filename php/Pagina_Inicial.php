<?php
session_start();

$servername = "localhost";
$username = "picify_db_editor";
$password = "#Ek11Mn35Gr06#";
$database = "picify_new_final_database";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("No se pudo conectar a la Base de Datos");
}

$nickname = $_SESSION['account_nickname'];
$name = $_SESSION['account_name'];
$surname = $_SESSION['account_surname'];
$email = $_SESSION['account_email'];
$profile_img = "../img/Perfil.png";

$result = $conn->query("CALL GET_IMG_PERFIL('$name', '$surname', '$email', '$nickname')");
if ($result && $row = $result->fetch_assoc()) {
    $profile_img = "../profilePictures/" . $row['IMG_Perfil'];
}

if ($profile_img == "../profilePictures/") {
    $profile_img = "../img/Perfil.png";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Página de Bienvenida">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Página de Bienvenida</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/Pagina_Inicial.css">
</head>
<body>
    <div class="background"></div>
    <header class="container-fluid d-flex justify-content-between align-items-center">
        <div id="logo">FOTOVERSO</div>
        <div id="buttons">
            <a href="../php/Sección_MisFotos.php" class="btn btn-outline-dark">Mis fotos</a>
            <a href="../php/Sección_Explorar.php" class="btn btn-outline-dark">Explorar</a>
            <a href="../php/Mi_Perfil.php" class="btn btn-outline-dark">Perfil</a>
            <a href="../php/Cerrar_Sesion.php" class="btn btn-danger">Cerrar Sesion</a>
        </div>
    </header>
    <main class="container text-center my-5">
        <h1 class="welcome-message">Bienvenido, <span id="username"><?= htmlspecialchars($nickname) ?>!</span></h1>
        <div id="profile-image-container">
            <a href="../php/Mi_Perfil.php" class="d-block">
                <img id="profile-image" style="height: 50%; width: 50%" src="<?= htmlspecialchars($profile_img) ?>" alt="Imagen de perfil" class="rounded-circle border border-light">
            </a>
        </div>
    </main>
</body>
</html>