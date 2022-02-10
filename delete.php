<?php 

// connecion a la bdd
require_once("connect.php");

$req = $db->prepare('DELETE FROM `produit` WHERE id = :idt LIMIT 1');
$req-> bindParam(":idt", $_GET["id"]);
$req->execute();

$_SESSION['message'] = "Produit Supprimé";
header('Location: index.php');

?>