<template>
    <div class="background">
        <div class="form-container">
            <div class="titles">
                <h1>Faites imprimer votre devis</h1>
            </div>

            <form id="form" action="http://lvauto/controleurs/c_controleur.php" method="post" class="info-form">
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
                        <option value="prestation">Prestation</option>
                        <option value="produit">Produit</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="details">Détails :</label>
                    <select id="details" name="details" v-model="selectedDetail" required>
                        <option v-for="(detail, index) in details" :key="index" :value="detail">
                            {{ detail.nom }} - {{ detail.prix }} €
                        </option>
                    </select>
                </div>

                <input type="hidden" name="details" :value="JSON.stringify(choix)" />

                <div class="form-group">
                    <button type="submit" class="submit-btn" @click="checkEtanim" :disabled="isLoading">
                        <span v-if="!isLoading">Envoyer</span>
                        <span v-else class="loader"></span>
                    </button>
                    <button type="button" class="add_btn" @click="dolist">Ajouter</button>
                </div>
            </form>
        </div>

        <!-- Liste des éléments ajoutés -->
        <div class="liste" v-if="choix.length > 0">
            <h3>Liste des éléments ajoutés</h3>
            <!--Pour chaque objet dans le tableau detail on créé un div avec les informations propres a l'objet-->
            <div class="content" v-for="(item, index) in choix" :key="index">
                <span>{{ item.detail.nom }} - {{ item.detail.prix }} €</span>
                <div class="right-side">
                    <input type="number" v-model.number="item.quantity" min="1">
                    <button @click="removeItem(index)">Supprimer</button>
                </div>
            </div>
        </div>

        <!-- Overlay et barre de progression -->
        <div v-if="isLoading" class="overlay">
            <div class="progress-bar">
                <div class="progress" :style="{ width: progress + '%' }"></div>
                <div class="progress-text">{{ progress }}%</div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

// Variables réactives
const selectedCategory = ref('');
const selectedDetail = ref('');
const details = ref([]); // Tableau pour stocker les détails dynamiques
const choix = ref([]); // Stocker les choix pour le devis
const isLoading = ref(false); // État de chargement
const progress = ref(0); // Progression

// Cette fonction est appelée lorsque la catégorie change
const fetchDetails = () => {
    // Détermine l'URL à utiliser en fonction de la catégorie sélectionnée
    let url = ''; // Initialise l'URL vide

    // Vérifie la catégorie sélectionnée et définit l'URL en conséquence
    if (selectedCategory.value === 'prestation') {
        url = 'http://lvauto/prestation/getprestation';
    } else if (selectedCategory.value === 'produit') {
        url = 'http://lvauto/produit/getproduit';
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
                details.value = data.content;
            })
            .catch(error => {
                // Affiche une erreur si quelque chose se passe mal avec la requête
                console.error('Erreur lors de la récupération des détails:', error);
            });
    } else {
        // Réinitialise les options si aucune catégorie n'est sélectionnée
        details.value = [];
    }
};

// Méthode pour lister les choix de l'utilisateur
const dolist = () => {
    if (selectedDetail.value) {
        const existingItem = choix.value.find(item => item.detail.nom === selectedDetail.value.nom);
        if (existingItem) {
            existingItem.quantity += 1; // Si l'élément existe déjà, augmenter la quantité
        } else {
            choix.value.push({
                detail: selectedDetail.value,
                quantity: 1,
                category: selectedCategory.value
            }); // Sinon, ajouter un nouvel élément
        }
        console.log(choix.value); // Pour tester
    }
};

// Méthode pour supprimer un élément
const removeItem = (index) => {
    choix.value.splice(index, 1);
};

const check = () => {
    document.getElementById("form").addEventListener("submit", function (event) {
        // Appel des différentes fonctions de validation
        if (!nom() || !prenom() || !adresse() || !mail()) {
            event.preventDefault(); // Empêche l'envoi du formulaire si une validation échoue
        }
    });

    function nom() {
        const nom = document.getElementById("nom").value;
        const nomRegex = /^[A-Za-z\s-]+$/; // Espaces et tirets
        if (nomRegex.test(nom)) {
            return true;
        } else {
            console.log("Nom invalide");
            return false;
        }
    }

    function prenom() {
        const prenom = document.getElementById("prenom").value;
        const prenomRegex = /^[A-Za-z\s-]+$/; // Même logique que pour le nom
        if (prenomRegex.test(prenom)) {
            return true;
        } else {
            console.log("prenom invalide");
            return false;
        }
    }

    function adresse() {
        const adresse = document.getElementById("adresse").value;
        const adresseRegex = /^[a-zA-Z0-9\s-x]+$/; // Même logique que pour le nom
        if (adresseRegex.test(adresse)) {
            console.log("Numéro valide");
            return true;
        } else {
            console.log("adresse invalide");
            return false;
        }
    }

    function mail() {
        const mailText = document.getElementById("email").value;
        const mailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$/i;
        if (mailRegex.test(mailText)) {
            return true
        } else {
            console.log("Mail invalide");
            return false;
        }
    }
};

const anim = () => {
    console.log('ok');
    isLoading.value = true;
    progress.value = 0;
    const interval = setInterval(() => {
        progress.value += 1;
        if (progress.value >= 100) {
            clearInterval(interval);
            isLoading.value = false;
            document.getElementById('form').submit();
        }
    }, 5); // 5ms pour une durée totale d'environ 500ms
};

const checkEtanim = (event) => {
    if (choix.value.length === 0) {
        alert("Veuillez ajouter au moins un élément avant de soumettre le formulaire.");
        event.preventDefault();
        return;
    }
    check();
    anim();
};
</script>

<style lang="scss">
.background {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #57b55c;

    .form-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        .titles {
            text-align: center;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .info-form {
            display: flex;
            flex-direction: column;

            .form-group {
                margin-bottom: 15px;

                label {
                    margin-bottom: 5px;
                    font-weight: bold;
                    display: block;
                }

                input,
                select {
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    box-sizing: border-box;
                    font-size: 14px;

                    input:focus,
                    select:focus {
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

                .loader {
                    border: 4px solid #f3f3f3;
                    /* Light grey */
                    border-top: 4px solid #3498db;
                    /* Blue */
                    border-radius: 50%;
                    width: 20px;
                    height: 20px;
                    animation: spin 2s linear infinite;
                    display: inline-block;
                }

                @keyframes spin {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
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
                    margin-left: 2%;

                    .add_btn:hover {
                        background-color: #b31e00;
                    }
                }
            }
        }
    }

    .liste {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        h3 {
            margin-bottom: 15px;
        }

        .content {
            display: flex;
            width: 100%;
            align-items: center;
            text-align: left;
            justify-content: space-between;
            margin-bottom: 10px;

            span {
                font-size: 16px;
                flex: 1; // Occupe tout l'espace à gauche
                text-align: left; // Alignement à gauche (par défaut, mais utile à préciser)
            }

            .right-side {
                display: flex;
                align-items: center; // Aligner la quantité et le bouton au centre
                gap: 10px; // Espace entre l'input et le bouton "Supprimer"


                input[type="number"] {
                    width: 50px;
                    text-align: center;
                }

                button {
                    background-color: #ff0000;
                    color: white;
                    border: none;
                    padding: 5px 10px;
                    border-radius: 4px;
                    cursor: pointer;

                    &:hover {
                        background-color: #b31e00;
                    }
                }
            }
        }
    }
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;

    .progress-bar {
        width: 80%;
        background: #ddd;
        border-radius: 10px;
        overflow: hidden;
        position: relative;

        .progress {
            height: 30px;
            background: #57b55c;
            width: 0;
            transition: width 0.2s;
        }

        .progress-text {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-weight: bold;
            line-height: 30px;
        }
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;

        .progress-bar {
            width: 80%;
            background: #ddd;
            border-radius: 10px;
            overflow: hidden;
            position: relative;

            .progress {
                height: 30px;
                background: #57b55c;
                width: 0;
                transition: width 0.2s;
            }

            .progress-text {
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                color: white;
                font-weight: bold;
                line-height: 30px;
            }
        }
    }
}
</style>
