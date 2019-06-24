<?php 


require_once("config.php");

$id = $_GET['id'];

$sql = new Sql();

$u = new Usuario();
$u->loadById($id);


/*
$u é um objeto... esse objeto é possivel escrever na tela (echo)
devido termos a função mágica __toString() implementada na classe Usuario
*/
echo $u;

?>