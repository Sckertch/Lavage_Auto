<?php
require __DIR__ . '/../vendor/autoload.php';

// Chargement des variables d'environnement depuis le fichier .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Connection
{   		
    private static $serveur;
    private static $bdd;   		
    private static $user;    		
    private static $mdp;
	private $conn;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	public function __construct(ContainerDI $c){
        $this->c = $c;
        
        // Récupération des variables d'environnement
        self::$serveur = $_ENV['DB_HOST'];
        self::$bdd = $_ENV['DB_NAME'];
        self::$user = $_ENV['DB_USER'];
        self::$mdp = $_ENV['DB_PASSWORD'];
        
		$dsn = 'mysql:host='.self::$serveur.';dbname='.self::$bdd.';user='.self::$user.';password='.self::$mdp;
		try{
            $monPDO = new PDO($dsn);
          
            $monPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $monPDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->conn = $monPDO;

        } catch (PDOException $e){
            $msg = 'ERREUR PDO DANS '. $e->getFile() . 'L.' . $e->getLine() . ' : ' . $e->getMessage();
            ssd($msg); 
        }
	}

	public function requete($sql,bool $a =false) {
        // Retourne la requete en brut pour jsonRequest()
		if ($a === true) {
			return $sql;
		}
        //Sinon on exécute la requete comme d'habitude en renvoyant les resulats sous forme de tableau
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function jsonRequest($sql){

        $result = $this->conn->query($this->requete($sql,true));
        //On créé un tableau pour stocker nos objet de la base de donnée
        $all = array();
        foreach ($result as $produits){
            array_push($all, $produits);
        }
        // ssd($all);
        //On renvoi les resultat les resultats en format json pour qu'il puissent etre interprétés par VueJs

        return $all;
    }
}



