<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Dompdf\Dompdf;

class Send{  

    function __construct(ContainerDI $c){

    }

    public function doPdf(array $tableau){
        // Récupérer les autres informations du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];

        $detailsArray = $tableau;
        // sage($detailsArray);

        // Préparer les données pour le PDF
        ob_start();
        // Passer le tableau des détails au fichier vDevis.php
        require_once __DIR__ . '/../vue3-lavageauto/Devis.php';
        $html = ob_get_contents();
        ob_end_clean();
        // die($html);

        if (empty($html)) {
            die("Erreur: Le contenu HTML est vide.");
        }

        // Générer le PDF
        $dom = new Dompdf();
        $dom->loadHtml($html);
        $dom->setPaper('A4', 'portrait');
        $dom->render();
        ob_end_clean();
        $name = 'Mon_PDF.pdf';
        $dom->stream($name);
    }
}
?>

