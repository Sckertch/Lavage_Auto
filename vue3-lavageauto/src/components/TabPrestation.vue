<template>
    <div class="tableau">
        <h2 class="title">Nos Prestations</h2>
        <transition-group name="fade" tag="div" class="liste">
           <!-- Ajoutez une clé unique pour chaque élément -->
            <!--Pour chaque objet dans le tableau prestation on créé un div avec les informations propres a l'objet-->
           <ListePrestation v-for="(prestation, index) in prestations" :key="prestation.id || index" :prestation="prestation"/>
        </transition-group>
        
    </div>
</template>

<script>
import ListePrestation from './ListePrestation.vue';



export default {
    
    components: {
        ListePrestation
    },
    data() {
        return {
            prestations: [] // Tableau pour stocker les prestations
        };
    },
    created() {
        // Récupération des données JSON depuis l'API PHP lors de la création du composant
        fetch('http://localhost/index/Lavage_auto/controleurs/Prestation.php') 
        .then(response => response.json()) // Convertit la réponse en JSON
        .then(data => {
            this.prestations = data; // Assigne les données au tableau produits
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des prestations:', error);
        });
    }

}
</script>

<style lang="scss">

    .title {
        text-align: center;
        color: #57b55c;
        border-top: 2px solid #57b55c;
        border-bottom: 2px solid #57b55c;
        text-align: center;
    }

    .liste{
        display: flex;
        flex-direction: column;
        align-items: center;

        /* Styles pour l'animation d'entrée */
        .fade-enter-active, .fade-leave-active {
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