<template>
    <div class="bandeau">
        <div class="logo">
            <!-- Glissez ici l'image ou l'icône du site -->
            <img src="../../../img/464310111004201.jpg">
        </div>
        <nav class="navbar">
            <ul>
                <li><a @click="sendValue('accueil')">Accueil</a></li>
                <li><a @click="sendValue('prestations')">Prestations</a></li>
                <li><a @click="sendValue('produits')">Produits</a></li>
                <li><a @click="sendValue('devis')">Devis</a></li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: "NavBar",
    methods: {
        sendValue(value) {
            // Émet un événement avec la valeur du bouton cliqué
            this.$emit('changement', value);
        }
    }
}
</script>

<style lang="scss">
.bandeau {
    width: 97, 5%;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 10px 20px;
    background-color: #333;
    color: white;

    .logo {
        img {
            height: 100px;
        }

    }

    .navbar {

        ul {
            list-style: none;
            display: flex;
            gap: 50px;

            li {
                margin: 0;

                a {
                    text-decoration: none;
                    color: white;
                    padding: 8px 16px;
                    transition: background-color 0.3s, color 0.3s;
                }

                a:hover {
                    background-color: #555;
                    border-radius: 4px;
                }
            }
        }
    }
}
</style>