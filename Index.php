<?php 
// Environnement de test
require __DIR__ . '/controleurs/ContainerDI.php';
require __DIR__ . '/vendor/autoload.php';


$c = new ContainerDI();
$moteur = new Moteur($c);

include("vProduit.php");
include("vPrestation.php");
include("vFormulaire.php");

