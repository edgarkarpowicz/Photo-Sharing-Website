<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Filtros de Búsqueda de Galerías">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Filtros de Galerías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/FiltrosGalerias.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-image: url('../img/SubirBorrar_Foto_Background.png'); background-size: cover;">

    <div class="card shadow-lg p-4" style="max-width: 500px; background: rgba(255, 255, 255, 0.9); border-radius: 20px;">
        <div class="card-body">
            <h5 class="card-title text-center">Filtros de Busqueda para Galerias</h5>
            <p class="card-subtitle mb-3 text-muted text-center">Ingrese los datos para configurar los filtros de busqueda</p>

            <form action="../php/Busqueda_Filtrada_Galerias.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de Usuario (Opcional):</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese el nombre de usuario">
                </div>

                <div class="mb-3">
                    <label for="gallery" class="form-label">Nombre de la Galeria (Opcional):</label>
                    <input type="text" name="gallery" id="gallery" class="form-control" placeholder="Ingrese el nombre de la galeria">
                </div>

                <button type="submit" style="letter-spacing: 5px; font-size: 30px" class="btn btn-primary w-100">Buscar</button>
            </form>
        </div>
    </div>

</body>
</html>