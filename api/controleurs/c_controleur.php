<?php  
require __DIR__ . '/ContainerDI.php';
require __DIR__ . '/../vendor/autoload.php';

$c = new ContainerDI();

// Récupérer le tableau des détails envoyés depuis le formulaire
$detailsJson = $_POST['details']; // 'details' est une chaîne JSON

// Créer un tableau pour stocker les détails avec les prix récupérés
$detailsArray = json_decode($detailsJson, true); 

// sage($detailsArray);
// sage($detailsJson);

foreach ($detailsArray as $detail) {
    $detailNom = $detail['detail']['nom'];
    $detailPrix = $detail['detail']['prix'];
    $detailQuantite = $detail['quantity'];
    $detailCategory = $detail['category'];

    // Requête pour obtenir le prix de chaque élément selon la catégorie et le nom
    $recup = $c->get('Connection')->requete("SELECT `prix` FROM `$detailCategory` WHERE `nom` = '$detailNom'");

}

// Passer le tableau des détails à la méthode `doPdf` pour générer le devis
$c->get('send')->doPdf($detailsArray);

