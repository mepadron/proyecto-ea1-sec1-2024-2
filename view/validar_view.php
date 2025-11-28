<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


include_once("controller/validar_controller.php");
// echo "hola soy vista";

if (isset($_POST['submit'])) {
    $objetct = new ValidarUsuario();
    echo "<br>";
    // print_r($_POST);
    $response = $objetct->login($_POST['usuario'], $_POST['password']);

    if ($response) {
        echo "usuario valido";
    } else {
        echo "usuario NOOOOOOO valido";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Usuario</title>
    <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->
    <link rel="stylesheet" href="../public/simple.css">
</head>

<body>

    <form action="#" method="post">
        <label for="">Usuario</label>
        <input type="text" name="usuario" id=""><br>
        <label for="">Password</label>
        <input type="password" name="password" id=""><br>
        <input type="submit" name="submit" value="Iniciar Sesion">
    </form>

</body>

</html>