<template>
    <div class="tableau">
        <h2 class="title">Nos Produits</h2>
        <transition-group name="fade" tag="div" class="liste">
            <!--Pour chaque objet dans le tableau produit on créé un div avec les informations propres a l'objet-->
            <ListeProduit v-for="(produit, index) in produits" :key="index" :produit="produit" />
        </transition-group>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ListeProduit from './ListeProduit.vue';

// Tableau pour stocker les produits
const produits = ref([]);

// Fonction pour récupérer les produits
const fetchProduits = () => {
    fetch('http://lvauto/produit/getproduit')
        .then(response => response.json())
        .then(data => {
            produits.value = data.content; // Assigne les données au tableau produits
            console.log(produits.value); // Affiche les produits dans la console
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des produits:', error);
        });
};

// Récupération des données JSON depuis l'API PHP lors du montage du composant
onMounted(() => {
    fetchProduits();
});
</script>

<style lang="scss">
.title {
    border-top: 2px solid #57b55c;
    border-bottom: 2px solid #57b55c;
    text-align: center;
    color: #57b55c;
}

.liste {
    display: flex;
    flex-direction: column;
    align-items: center;

    /* Styles pour l'animation d'entrée */
    .fade-enter-active,
    .fade-leave-active {
        transition: all 1s ease;
    }

    .fade-enter-from {
        opacity: 0;
        transform: translateY(30px);
    }

    .fade-enter-to {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-leave-from {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-leave-to {
        opacity: 0;
        transform: translateY(30px);
    }
}
</style>