<?php 

require_once("config.php");

//?id=1&login=teste&pwd=1234
$id = $_GET['id'];
$login = $_GET['login'];
$pwd = $_GET['pwd'];

$u = new Usuario();

$u->loadById($id);

$l = $u->loginExists($login);

if(count($l) > 0) {
    if(intval($l['idusuario']) !== $u->getIdusuario()){

        echo "nome de usuario já utlizado!";
        die();

    }
}


$u->update($login,$pwd);

echo $u;

?>