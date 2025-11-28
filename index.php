<?php
// Permitir servir archivos estáticos desde /public/
$requested_uri = $_SERVER['REQUEST_URI'];
$query_string_pos = strpos($requested_uri, '?');
if ($query_string_pos !== false) {
    $requested_uri = substr($requested_uri, 0, $query_string_pos);
}

// Si la solicitud es para un archivo dentro de /public/
if (strpos($requested_uri, '/public/') === 0) {
    $file_path = __DIR__ . $requested_uri;
    if (file_exists($file_path) && is_file($file_path)) {
        // Sirve el archivo estático directamente
        return false;
    }
}

//private para adjuntar una variable o propiedad a una clase
//ej private $login="mp"; entre comillas cadena de caracteres
//$pass=123; numeros enteros
//si en vez de de private es PUBLIC entonces la propiedad o la variable es general
/*
class ValidarUsuario{
private $login="mp";
private $pass="123";

public function login($l, $p){
    if($l==$this->login AND $p==$this->pass){
        echo "Bienvenido al Sistema";
    }else{
        echo "Credenciales no Existen";
    }
}
}
$s=new ValidarUsuario();
$s->login("mp", "123");

//                {C - controlador -> puente
// arquitectura<- {M - modelo
//                {V - vista     
*/
include_once("view/validar_view.php");
