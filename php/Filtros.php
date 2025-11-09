<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Filtros de Fotos">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Filtros de Fotos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Filtros.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-image: url('../img/SubirBorrar_Foto_Background.png'); background-size: cover;">

    <div class="card shadow-lg p-4" style="max-width: 500px; background: rgba(255, 255, 255, 0.9); border-radius: 20px;">
        <div class="card-body">
            <h5 class="card-title text-center">Filtros de Busqueda para Fotos</h5>
            <p class="card-subtitle mb-3 text-muted text-center">Ingrese los datos para configurar los filtros de busqueda</p>

            <form action="../php/Busqueda_Filtrada.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Orden:</label>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="Ascendente" name="order" value="Ascendente" class="form-check-input">
                        <label for="Ascendente" class="form-check-label">ASC</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="Descendente" name="order" value="Descendente" class="form-check-input">
                        <label for="Descendente" class="form-check-label">DES</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de Usuario (Opcional):</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese su nombre de usuario">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Categoria (Opcional):</label>
                    <input type="text" name="category" id="category" class="form-control" placeholder="Ingrese la categoria">
                </div>

                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </form>
        </div>
    </div>

</body>
</html>