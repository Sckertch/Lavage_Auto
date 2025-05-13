<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../api/controleurs/send.php';

date_default_timezone_set('America/Guadeloupe'); //Définir le fuseau horaire
$date = date('d/m/Y'); //Définition de la date au format jj/mm/yyyy
$heure = date('H:i'); //Défintion de l'heure

 //Génération d'un numéro de devis aléatoire
$numDev = str_pad(mt_rand(0,99999999), 8, '0', STR_PAD_LEFT);
?>

<div class="invoice-container">

    <!-- En-tête du devis-->
    <header>
        <h1>Facture de Devis</h1>
        <div class="company-details">
            <p><strong>LEDAX CAR SHINE</strong></p>
            <p>Boulevard des héros 97139 Les Abymes</p>
            <p>Email: mleda971@gmail.com</p>
            <p>Téléphone: 06 90 93 04 89</p>
        </div>
    </header>
    
    <section class="invoice-info">
        <div class="invoice-details">
            <p><strong>Numéro de Devis:</strong> <?php echo $numDev;?></p>
            <p><strong>Date:</strong>Le <?php echo $date; ?> à <?php echo $heure; ?></p>
        </div>
        <div class="client-details">
            <p><strong>Client:</strong></p>
            <p><?php echo $nom.' '.$prenom ?></p>
            <p><?php echo $adresse?></p>
            <p><?php echo $email?></p>
            <p><?php echo $telephone?></p>
        </div>
    </section>

        <!--Listing des articles-->
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $totalHT = 0; //Total HT
                //Selon la quantité d'informations récupérés via le formulaire on effectue le listing des articles dans le devis
                foreach ($detailsArray as $detail){  
                    // sage($detail);
                    $total = $detail['quantity'] * $detail['detail']['prix']; //Calcul du cout total
                    $totalHT += $total;
                    echo "<tr>
                            <td>{$detail['detail']['nom']}</td>
                            <td>{$detail['quantity']}</td>
                            <td>{$detail['detail']['prix']} €</td>
                            <td>{$total} €</td>
                          </tr>";
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="total-label">Total HT</td>
                <td><?php echo $totalHT ?> €</td>
            </tr>
            <tr>
                <td colspan="3" class="total-label">TVA (20%)</td>
                <td><?php $tva = $totalHT * 0.20; echo $tva?> €</td>
            </tr>
            <tr>
                <td colspan="3" class="total-label">Total TTC</td>
                <td><?php echo $tva + $totalHT;?> €</td>
            </tr>
        </tfoot>
    </table>

    <footer>
        <p>Merci pour votre confiance !</p>
        <p>Conditions de paiement : paiement à 30 jours.</p>
    </footer>
</div>
</html>

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    }

    .invoice-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
        text-align: center;
        border-bottom: 2px solid #007BFF;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .company-details {
        text-align: left;
    }

    .invoice-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .invoice-info .invoice-details,
    .invoice-info .client-details {
        width: 45%;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .invoice-table th,
    .invoice-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .invoice-table th {
        background-color: #007BFF;
        color: white;
    }

    .invoice-table tfoot td {
        font-weight: bold;
    }

    .total-label {
        text-align: right;
    }

    footer {
        text-align: center;
        font-size: 0.9em;
        color: #555;
        margin-top: 20px;
    }
</style>
