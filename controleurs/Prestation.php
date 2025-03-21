<?php
header("Access-Control-Allow-Origin: *"); // Permettre l'accès depuis n'importe quel domaine
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Méthodes HTTP autorisées
header("Access-Control-Allow-Headers: Content-Type"); // Headers autorisés

require __DIR__ . '/ContainerDI.php';
require __DIR__ . '/../vendor/autoload.php';

$c = new ContainerDI();
$moteur = new Moteur($c);

$b = $c->get('Connection')->JsonRequest("SELECT * FROM Prestation", true);
echo $b;
// sage($b);
// foreach ($b as $prestations){
//     echo "<tr>";
//     echo "<td>" . $prestations->nom. "</td>";
//     echo "<br>";
//     echo "<td>" . $prestations->caractéristiques. "</td>";
//     echo "<br>";
//     echo "<td>" . $prestations->description. "</td>";
//     echo "<br>";
//     echo "<td>" . $prestations->prix. "</td>";
//     echo "<br>";
//     echo "<br>";
//     echo "</tr>";
// }
?>