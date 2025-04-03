

<?php
require_once "model\PartieDAO.php";
require_once "model\JoueurDAO.php";

$dao = new PartieDAO;
$e = $dao -> getAll();
var_dump($e);

$dao -> ajoutePartie(4,"2024/02/11",500,100);


?>

