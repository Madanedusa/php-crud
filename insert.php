<?php 

require_once("config.php");

$login = isset($_GET['login']) ? $_GET['login'] : false;
$pwd = isset($_GET['pwd']) ? $_GET['pwd'] : false;

if(!$login || !$pwd){
    echo "informe o login e a senha (?login=teste&pwd=senha)";
    die();
}

$u = new Usuario();

if(count($u->loginExists($login)) > 0) {
    echo "nome de usuario cadastrado!";
    die();
}

$u->insert($login,$pwd);

echo $u;

?>