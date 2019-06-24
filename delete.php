<?php 

require_once("config.php");

$id = $_GET['id'];

$u = new Usuario();

$u->loadById($id);

$u->delete();

echo $u;

?>