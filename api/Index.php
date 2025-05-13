<?php 
// Environnement de test
require __DIR__ . '/controleurs/Cors.php';
require __DIR__ . '/controleurs/ContainerDI.php';
require __DIR__ . '/vendor/autoload.php';


$c = new ContainerDI();
$c->get("Routing")->dispatch(
    $c->get('Routing')->dispatcher(),
    $c->get('Routing')->httpMethod,
    $c->get('Routing')->uri);
// include("vProduit.php");
// include("vPrestation.php");
// include("vFormulaire.php");

