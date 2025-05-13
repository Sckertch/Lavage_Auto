<template>
    <div class="capsule">
        <div class="acceuil--fond">
            <div class="presentation">
                <div class="img">
                    <CarouselCar />
                </div>

                <div class="text">
                    <p>N°1 du service de nettoyage en Guadeloupe</p>
                </div>
            </div>

        </div>

        <div class="phrase">
            <h3>Vous serez conquit par notre personnel qui vous fournira un travail de qualité.</h3>
        </div>

    </div>
</template>

<script setup>
import CarouselCar from './CarouselCar.vue';
</script>

<style lang="scss">
.acceuil--fond {
    display: flex;

    width: 100%;
    align-items: center;
    justify-content: center;

    .presentation {
        display: flex;
        // flex-direction: row;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        max-width: 1200px;

        .img {
            width: 100%;
        }

        .text {
            width: 60%;
            text-align: left;
            padding-left: 20%;
            /* Ajoute un peu d'espace entre l'image et le texte */
        }

    }
}

.phrase {
    border-top: 2px solid #57b55c;
    border-bottom: 2px solid #57b55c;
    text-align: center;
    margin-top: 10%;
    color: #57b55c;
}
</style>