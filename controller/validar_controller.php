<?php
include_once("model/validar_model.php");
class ValidarUsuario{

public function login($l, $p){
    $conex=new ValidarModel();
    $response=$conex->validar_user($l, $p);
    // print_r($conex);
    return $response;
}
}
