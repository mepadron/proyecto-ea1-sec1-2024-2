<?php
class ValidarModel{
    private $login="mp";
    private $pass="123";

 public function validar_user($l, $p){
        // echo "$l - $p<br>";
        // echo "$this->login - $this->pass<br>";
  if($l==$this->login AND $p==$this->pass){
        return true;
    }else{
        return false;
    }
}


}