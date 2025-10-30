<?php
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