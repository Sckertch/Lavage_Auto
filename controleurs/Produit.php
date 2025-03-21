
<?php
header("Access-Control-Allow-Origin: http://localhost:8080"); // Permettre l'accès depuis n'importe quel domaine
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Méthodes HTTP autorisées
header("Access-Control-Allow-Headers: Content-Type"); // Headers autorisés

require __DIR__ . '/ContainerDI.php';
require __DIR__ . '/../vendor/autoload.php';


$c = new ContainerDI();
$moteur = new Moteur($c);

$a = $c->get("Connection")->jsonRequest("SELECT * FROM Produit",true);
// $a = $c->get("Connection")->requete("SELECT * FROM Produit");
echo $a;
// sage($a);
// foreach ($a as $produits){
//     echo "<tr>";
//     echo "<td>" . $produits->nom. "</td>";
//     echo "<br>";
//     echo "<td>" . $produits->caractéristiques. "</td>";
//     echo "<br>";
//     echo "<td>" . $produits->description. "</td>";
//     echo "<br>";
//     echo "<td>" . $produits->prix. "</td>";
//     echo "<br>";
//     echo "<br>";
//     echo "</tr>";
// }


?>
