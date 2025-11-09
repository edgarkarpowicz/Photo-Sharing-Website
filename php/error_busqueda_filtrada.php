<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Error en Busqueda Filtrada">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Error en Busqueda Filtrada</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/error_busqueda_filtrada.css">
</head>
<body>
    <div class="error-container">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h5 class="card-title">ERROR EN BUSQUEDA FILTRADA</h5>
                    <h6 class="card-subtitle mb-3 text-danger">¡HA OCURRIDO UN ERROR!</h6>
                    <p class="text-muted">Ha habido un Error realizando la Busqueda Filtrada. Verifique los datos ingresados.</p>
                    <div>
                        <a href="../php/Pagina_Inicial.php">
                            <button class="btn btn-primary btn-lg mt-4">Volver</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>