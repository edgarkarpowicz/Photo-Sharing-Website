<?php
$servername = "localhost"; // or the server address provided by your web host
$username = "picify_db_editor"; // your database username
$password = "#Ek11Mn35Gr06#"; // your database password
$database = "picify_new_final_database"; // your database name

$conn = new mysqli($servername, $username, $password, $database);

$Nickname = $_POST['nickname'];
$Nombre = $_POST['name'];
$Apellido = $_POST['surname'];
$Email = $_POST['email'];

if (!empty($Nombre) || !empty($Apellido) || !empty($Email) || !empty($Nickname)) {
    if (mysqli_connect_error()) {
        header("Location: ../html/ingresarcuenta_error.html"); 
        die();
    } else {
        $result = mysqli_query($conn , "CALL SEARCH_FOR_CUENTA('$Nombre', '$Apellido', '$Email', '$Nickname')");
        if($result->num_rows == 1) {
            session_start();
            $_SESSION['account_name'] = $Nombre;
            $_SESSION['account_surname'] = $Apellido;
            $_SESSION['account_email'] = $Email;
            $_SESSION['account_nickname'] = $Nickname;
            header("Location: ../php/Pagina_Inicial.php"); 
            die();
        } else {
            header("Location: ../html/ingresarcuenta_error.html"); 
            die();
        }
    }
} else {
    header("Location: ../html/ingresarcuenta_error.html"); 
}
$conn->close();
?>