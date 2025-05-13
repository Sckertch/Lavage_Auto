<?php
require __DIR__ . '/../vendor/autoload.php';
class Connection
{   		
    private static $serveur='localhost';
    private static $bdd='lavage';   		
    private static $user='root' ;    		
    private static $mdp='';
	private $conn;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct(ContainerDI $c){
		
        $this->c = $c;
		$this->conn = new mysqli(self::$serveur, self::$user, self::$mdp, self::$bdd);
	}

	public function getLesProduits(){
	// Vérification de la connexion
		if ($this->conn->connect_error) {
			die("Erreur de connexion à la base de données : " . $this->conn->connect_error);
		}

		$sql = "SELECT * FROM produit";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			$all = array();
			foreach ($result as $produits){
				array_push($all,$produits);
			}
			header('Content-Type: application/json');
			return json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		} else {
			return "error";
		}
	}

	public function getPrix($cate, $obj){
	// Vérification de la connexion
		if ($this->conn->connect_error) {
			die("Erreur de connexion à la base de données : " . $this->conn->connect_error);
		}

		$sql = "SELECT `prix` FROM `$cate` WHERE `nom` = '$obj'";
		// Préparer la requête
		if ($stmt = $this->conn->prepare($sql)) {
			
			// Exécuter la requête
			$stmt->execute();
			
			// Stocker le résultat
			$stmt->store_result();
			
			// Vérifier si des résultats ont été trouvés
			if ($stmt->num_rows > 0) {
				// Lier les variables au résultat
				$stmt->bind_result($prix);
				$stmt->fetch();
				
				// Retourner la valeur de `prix`
				return $prix;
			}
		}
	}
	
	public function getLesPrestations(){
	// Vérification de la connexion
		if ($this->conn->connect_error) {
			die("Erreur de connexion à la base de données : " . $this->conn->connect_error);
		}

		$sql = "SELECT * FROM prestation";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
			$all = array();
			foreach ($result as $prestation){
				array_push($all, $prestation);
			}
			header('Content-Type: application/json');
			return json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		} else {
			return "error";
		}
	}

}



?>
