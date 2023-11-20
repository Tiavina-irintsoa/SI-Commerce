<?php
require_once 'nuts.php';

// affichage du nombre
$nombre = 1405.23;
echo $nombre;

// méthode avec la classe nuts
$nuts = new nuts($nombre, 'EUR');
echo $nuts->convert('fr-FR');

?>