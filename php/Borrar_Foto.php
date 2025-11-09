<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fotoverso - Borrar una Foto">
    <meta name="keywords" content="HTML, CSS, PHP, Fotos, Fotoverso, Imágenes, Red-Social, Comunicación">
    <title>Fotoverso - Borrar una Foto</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/BorrarFoto.css">
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-image: url('../img/SubirBorrar_Foto_Background.png'); background-size: cover;">

    <div class="card mx-auto shadow-lg p-4" style="max-width: 500px; background: rgba(255, 255, 255, 0.9); border-radius: 20px;">
        <div class="card-body">
            <h5 class="card-title text-center">BORRAR UNA FOTO</h5>
            <p class="card-subtitle mb-3 text-muted text-center">¡Ingrese los siguientes datos para borrar su foto!</p>
            
            <form action="../php/LLAMAR_BORRAR_FOTO.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <!-- <label type="hidden" for="date" class="form-label">Fecha de la foto:</label> -->
                    <td> <input type="hidden" name="internal_id" value="<?php echo $_POST['internal_id'] ?>"> </td>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label"> Fecha de cuando se subio la Foto: </label>
                    <input id="date" type="date" name="date" class="form-control" min="1900-01-01" max="2023-12-11" required>
                </div>
                
                <div class="mb-4">
                    <label for="category" class="form-label"> Descripción de la foto:</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Ej. Naturaleza, Viajes" required>
                </div>
                
                <button type="submit" style="letter-spacing: 5px; font-size: 20px"class="btn btn-primary w-100">Borrar su Foto</button>
            </form>
        </div>
    </div>
    <script src="../js/obtenedor_de_fecha.js" type="text/javascript"></script>
</body>
</html>