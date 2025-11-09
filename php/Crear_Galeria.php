<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Crear una Galeria">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Crear una Galeria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/CrearGaleria.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-image: url('../img/SubirBorrar_Foto_Background.png'); background-size: cover;">

    <div class="card mx-auto shadow-lg p-4" style="max-width: 500px; background: rgba(255, 255, 255, 0.9); border-radius: 20px;">
        <div class="card-body">
            <h5 class="card-title text-center">CREAR UNA GALERIA</h5>
            <p class="card-subtitle mb-3 text-muted text-center">Ingrese los siguientes datos para crear su galeria</p>
            
            <form action="../php/LLAMAR_CREAR_GALERIA.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la Galeria:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre de tu galeria" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Descripcion de la Galeria:</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Describe tu galeria" required>
                </div>
                
                <div class="mb-4">
                    <label for="fileToUpload" class="form-label">Imagen de Portada:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                </div>
                
                <button type="submit" style="letter-spacing: 5px; font-size: 25px" class="btn btn-primary w-100">Crear</button>
            </form>
        </div>
    </div>
</body>
</html>