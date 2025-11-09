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
$Phone = $_POST['phone'];
$BirthDate = $_POST['date'];

$phoneVerification = file_get_contents("https://phonevalidation.abstractapi.com/v1/?api_key=0093ffaa0a224ab282fdb49684dff00f&phone={$Phone}");
$output = json_decode($phoneVerification);

if ($output && isset($output->valid) && $output->valid === false) {
    header("Location: ../html/crearcuenta_error.html");
    die();
}

$mailVerification = file_get_contents("https://api.quickemailverification.com/v1/verify?email={$Email}&apikey=5e4b200f2217c6665685e2e3ff57609fbf8fb63bcebf8318bb7a48d8eeac");
$mailOutput = json_decode($mailVerification);

if ($mailOutput && ($mailOutput->result == "invalid" || $mailOutput->result == "unknown")) {
    header("Location: ../html/crearcuenta_error.html");
    die();
}

if (!empty($Nombre) || !empty($Apellido) || !empty($Email) || !empty($Phone) || !empty($Nickname) || !empty($BirthDate)) {
    if (mysqli_connect_error()) {
        header("Location: ../html/crearcuenta_error.html");
        die();
    } else {
        $result = mysqli_query($conn , "CALL CHECK_EMAIL_AND_NICKNAME('$Email', '$Nickname')");
        if ($result->num_rows == 0) {
            $result->close();
            $conn->next_result();
            mysqli_query($conn, "CALL INTRODUCIR_FOTOGRAFO('$Nombre', '$Apellido', '$Email', '$Phone', '$Nickname', '$BirthDate')");
            session_start();
            $_SESSION['account_name'] = $Nombre;
            $_SESSION['account_surname'] = $Apellido;
            $_SESSION['account_email'] = $Email;
            $_SESSION['account_nickname'] = $Nickname;
            header("Location: ../php/Pagina_Inicial.php");
            die();
        } else {
            header("Location: ../html/crearcuenta_error.html");
        }
    }
} else {
    header("Location: ../html/crearcuenta_error.html");
}
$conn->close();
?>