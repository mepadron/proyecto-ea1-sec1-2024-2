<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


include_once("controller/validar_controller.php");
// echo "hola soy vista";

if (isset($_POST['submit'])) {
    $objetct = new ValidarUsuario();
    $response = $objetct->login($_POST['usuario'], $_POST['password']);

    if ($response) {
        header("Location: home");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Usuario</title>
    <link rel="stylesheet" href="public/simple.css">
</head>

<body>

    <?php if (isset($error)): ?>
        <blockquote style="color: var(--error); border-left: 5px solid red;">
            <?php echo $error; ?>
        </blockquote>
    <?php endif; ?>

    <form action="#" method="post">
        <label for="">Usuario</label>
        <input type="text" name="usuario" id=""><br>
        <label for="">Password</label>
        <input type="password" name="password" id=""><br>
        <input type="submit" name="submit" value="Iniciar Sesion">
    </form>

</body>

</html>