<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


include_once("controller/validar_controller.php");
// echo "hola soy vista";

$objetct = new ValidarUsuario();
echo "<br>";
$response=$objetct->login("mpdfsfdfd", "123");

if($response){
    echo "usuario valido";
}else{
    echo "usuario NOOOOOOO valido";
}
?>