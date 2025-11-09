<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Error en Creación de Galería">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Error en Creación de Galería</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/creargaleria_error.css">
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-image: url('../img/SubirBorrar_Foto_Background.png'); background-size: cover;">

    <div class="card mx-auto shadow-lg p-4" style="max-width: 500px; background: rgba(255, 255, 255, 0.9); border-radius: 20px;">
        <div class="card-body">
            <h5 class="card-title text-center">ERROR EN CREACION DE GALERIA</h5>
            <p class="card-subtitle mb-3 text-muted text-center">¡No se ha podido crear la Galeria!</p>
            
            <form action="../php/Mis_Galerias.php" method="POST" enctype="multipart/form-data">
                <button type="submit" style="letter-spacing: 5px; font-size: 20px"class="btn btn-primary w-100">VOLVER</button>
            </form>
        </div>
    </div>
</body>
</html>