<template>
    <div class="produit--card">
        <div class="produit--image" :style="{ backgroundImage: `url(${produit.link})` }">

        </div>
        <div class="produit--info">
            <div class="titles">
                <h2>{{ produit.nom }}</h2>
            </div>
            <div class="carac">
                <p>{{ produit.caractéristiques }}</p>
            </div>


            <div class="prix">
                <p>{{ produit.prix }} €</p>
            </div>


        </div>


    </div>
</template>

<script setup>
// Définir les props attendues par le composant
const props = defineProps({
    produit: {
        type: Object,
        required: true
    }
});
</script>

<style lang="scss">
.produit--card {
    font-family: cursive;
    display: flex;
    flex-direction: row;
    width: 70%;
    height: 275px;
    background-color: #a9ce55;
    background-attachment: fixed;
    background-position: center;
    margin-top: 10px;
    margin-bottom: 10px;
    border: 5px solid #57b55c;


    .produit--image {
        width: 250px;
        position: relative;
        background-size: cover;
    }

    .produit--info {
        width: 70%;
        position: relative;
        display: flex;
        flex-direction: column;
        position: relative;

        .titles {
            text-align: center;

            h2 {
                margin-top: 5px;

            }
        }

        .carac {
            margin: 2%;

        }

        .prix {
            position: absolute;
            bottom: 0;
            right: 0;
            margin-right: 5px;
            margin-bottom: 5px;
            border: 2px solid #57b55c;
            text-align: center;
            margin-top: 10%;
            background-color: #57b55c;
            color: #ffffff;

            p {
                padding-left: 10px;
                padding-right: 10px;
                color: #000000;
            }
        }
    }
}
</style>
