<template>
    <div class="backgroundd">
        <div class="form-container">
            <div class="title">
                <h1>Faites imprimer votre devis</h1>
            </div>

            <form id="form" action="http://localhost/index/Lavage_auto/classes/c_controleur.php" method="post" class="info-form">
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
                    <select id="category" name="category" v-model="selectedCategory" @change="fetchDetails" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="prestation">Prestation</option>
                        <option value="produit">Produit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="details">Détails :</label>
                    <select id="details" name="details" v-model="selectedDetail" required>
                        <option v-for="(detail,index) in details" :key="index" :value="detail.nom">
                            {{ detail.nom }} - {{ detail.prix }} €
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Envoyer</button>
                    <button type="button" class="add_btn" @click="dolist">Ajouter</button>
                </div>
            </form>
        </div>

        <div class="liste">
            <div class="content" v-for="(choix,index) in choix" :key="index"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormDevis",
    data() {
        return {
            selectedCategory: '',
            selectedDetail: '',
            details: [], // Tableau pour stocker les détails dynamiques
            obj:[],
            choix: [] // Stocker les choix pour le devis
        };
    },
    methods: {
    // Cette méthode est appelée lorsque la catégorie change
        fetchDetails() {
            // Détermine l'URL à utiliser en fonction de la catégorie sélectionnée
            let url = ''; // Initialise l'URL vide

            // Vérifie la catégorie sélectionnée et définit l'URL en conséquence
            if (this.selectedCategory === 'prestation') {
                url = 'http://localhost/index/Lavage_auto/vPrestation.php';
            } else if (this.selectedCategory === 'produit') {
                url = 'http://localhost/index/Lavage_auto/vProduit.php';
            }

            // Si l'URL est définie (c'est-à-dire que la catégorie est sélectionnée)
            if (url) {
                // Effectue une requête pour obtenir les données depuis l'URL
                fetch(url)
                    .then(response => {
                        // Convertit la réponse en JSON
                        return response.json();
                    })
                    .then(data => {
                        // Met à jour les options "Détails" en fonction des données obtenues
                        // On suppose que chaque élément dans "data" a un "id" et un "nom"
                        this.details = data;// Valeur à envoyer lors de la soumission du formulaire;
                    })
                    .catch(error => {
                        // Affiche une erreur si quelque chose se passe mal avec la requête
                        console.error('Erreur lors de la récupération des détails:', error);
                    });
            } else {
                // Réinitialise les options si aucune catégorie n'est sélectionnée
                this.details = [];
            }
        },
        dolist(value1,value2){
            this.choix.push(value1,value2);
            console.log(this.choix);
        }
    }
};
</script>

<style lang="scss">
    .backgroundd{
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fbf7e8;

        .form-container{
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fbf7e8;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            .title{
                text-align: center;
                border-bottom: 2px solid #007BFF;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .info-form{
                display: flex;
                flex-direction: column;

                .form-group{
                    margin-bottom: 15px;

                    label {
                        margin-bottom: 5px;
                        font-weight: bold;
                        display: block;
                    }

                    input, select {
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #fbf7e8;
                        border-radius: 4px;
                        box-sizing: border-box;
                        font-size: 14px;

                        input:focus, select:focus {
                            border-color: #007BFF;
                            outline: none;
                        }
                    }

                    .submit-btn {
                        background-color: #007BFF;
                        color: white;
                        border: none;
                        padding: 10px 15px;
                        cursor: pointer;
                        border-radius: 4px;
                        font-size: 16px;

                        .submit-btn:hover {
                            background-color: #0056b3;
                        }
                    }

                    .add_btn {
                        background-color: #ff0000;
                        color: white;
                        border: none;
                        padding: 10px 15px;
                        cursor: pointer;
                        border-radius: 4px;
                        font-size: 16px;
                        margin-left:2%;

                        .add_btn:hover {
                            background-color: #b31e00;
                        }
                    }
                }
            }
        }
    }
</style>
