<?php 

require_once("config.php");

$id = $_GET['id'];

$u = new Usuario();

$u->loadById($id);

$u->delete();

//escrevendo
echo $u . date('Y-m-d');

?>