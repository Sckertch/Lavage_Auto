
<div class="form-container">
    <header>
        <h1>Formulaire d'Informations</h1>
    </header>

    <form id="form" action="classes/c_controleur.php" method="post" class="info-form">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required>
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="category">Catégorie :</label>
            <select id="category" name="category" required>
                <option value="">Sélectionnez une catégorie</option>
                <option value="prestation">Prestation</option>
                <option value="produit">Produit</option>
            </select>
        </div>

        <div class="form-group">
            <label for="details">Détails :</label>
            <select id="details" name="details" required>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-btn">Envoyer</button>
        </div>
    </form>
</div>

<script>
    console.log('La fonction JavaScript a été exécutée.');

    // JavaScript pour mettre à jour dynamiquement la deuxième liste déroulante en fonction du choix
    document.getElementById('category').addEventListener('change', function() {
        var details = document.getElementById('details');
        details.innerHTML = ''; // Réinitialiser les options

        // Ajouter une option par défaut
        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'Sélectionnez les détails';
        details.appendChild(defaultOption);

        // Ajouter des options en fonction de la sélection
        if (this.value === 'prestation') {
            var option1 = document.createElement('option');
            option1.value = 'Lavage extérieur';
            option1.text = 'Lavage extérieur';
            details.appendChild(option1);

            var option2 = document.createElement('option');
            option2.value = 'Lavage extérieur';
            option2.text = 'Lavage extérieur';
            details.appendChild(option2);
            
            var option3 = document.createElement('option');
            option3.value = 'Lavage intérieur et extérieur';
            option3.text = 'Lavage intérieur et extérieur';
            details.appendChild(option3);
            
            var option4 = document.createElement('option');
            option4.value = 'Traitement céramique';
            option4.text = 'Traitement céramique';
            details.appendChild(option4);
            
            var option5 = document.createElement('option');
            option5.value = 'Lustrage intégrale';
            option5.text = 'Lustrage intégrale';
            details.appendChild(option5);
        } else if (this.value === 'produit') {
            var option1 = document.createElement('option');
            option1.value = 'Coffret lavage normal';
            option1.text = 'Coffret lavage normal';
            details.appendChild(option1);

            var option2 = document.createElement('option');
            option2.value = 'Coffret lavage premium';
            option2.text = 'Coffret lavage premium';
            details.appendChild(option2);
            
            var option3 = document.createElement('option');
            option3.value = 'Coffret lavage exclusif';
            option3.text = 'Coffret lavage exclusif';
            details.appendChild(option3);
            
            var option4 = document.createElement('option');
            option4.value = 'Bouteille de savon ultra moussant';
            option4.text = 'Bouteille de savon ultra moussant';
            details.appendChild(option4);
            
            var option5 = document.createElement('option');
            option5.value = 'Pulvérisateur lustrant déperlant';
            option5.text = 'Pulvérisateur lustrant déperlant';
            details.appendChild(option5);
            
            var option6 = document.createElement('option');
            option6.value = 'Cire lustrante';
            option6.text = 'Cire lustrante';
            details.appendChild(option6);
        }
    });

// document.getElementById('info-form').addEventListener('submit', function(event) {
//     event.preventDefault(); // Empêche la soumission par défaut du formulaire

//     // Récupère les données du formulaire
//     var formData = new FormData(this);

//     // Envoie les données via AJAX à un script PHP
//     fetch('process.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.text()) // Traite la réponse comme du texte
//     .then(data => {
//         // Affiche la réponse du serveur
//         console.log(data);
//         alert("Données soumises avec succès !");
//     })
//     .catch(error => {
//         console.error('Erreur:', error);
//     });
// });



</script>

</html>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.form-container {
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

.info-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
    display: block;
}

input, select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

input:focus, select:focus {
    border-color: #007BFF;
    outline: none;
}

.submit-btn {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
}

.submit-btn:hover {
    background-color: #0056b3;
}

footer {
    text-align: center;
    font-size: 0.9em;
    color: #555;
    margin-top: 20px;
}
</style>
