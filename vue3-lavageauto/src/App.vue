<template>
  <div id="App">
  
    <NavBar @changement="page" id="navbar"/>
    <h1>LEDAX CAR SHINE</h1>

    <!-- Ajoutez le composant transition autour des templates dynamiques -->
    <transition name="fade" mode="out-in" class="contenu">
      <div :key="valeur">
        <AcceuilPage v-show="valeur === 'accueil'" />
        <TabProduit v-show="valeur === 'produits'" />
        <TabPrestation v-show="valeur === 'prestations'" />
        <FormDevis v-show="valeur === 'devis'" />
        <MentionsLegales v-show="valeur === 'mention'" />
      </div>
    </transition>

    <FooterPage @changement="page" class="foot"/>

  </div>
</template>

<script>
import AcceuilPage from './components/AcceuilPage.vue';
import FooterPage from './components/FooterPage.vue';
import FormDevis from './components/FormDevis.vue';
import MentionsLegales from './components/MentionsLegales.vue';
import NavBar from './components/NavBar.vue';
import TabPrestation from './components/TabPrestation.vue';
import TabProduit from './components/TabProduit.vue';



export default {
  name: 'App',
  components: {
    TabProduit,
    TabPrestation,
    NavBar,
    FormDevis,
    AcceuilPage,
    FooterPage,
    MentionsLegales
  },
  data() {
    return {
      valeur: '' // Variable pour stocker la valeur
    }
  },
  methods: {
    page(value) {
      this.valeur = value; // Met à jour la variable avec la valeur du bouton cliqué
    }
  },
  mounted() {
    // Initialise 'valeur' à 'Accueil' si elle est vide au chargement du composant
    if (!this.valeur) {
      this.valeur = 'accueil';
    }
  }
}
</script>

<style lang="scss">
  #app {

    #navbar {
      position: relative;
    }

    h1 {
      text-align: center;
    }

    /* Ajoutez les classes de transition pour le fondu */
    .fade-enter-active, .fade-leave-active {
      transition: opacity 0.75s ease;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active dans les anciennes versions de Vue */ {
      opacity: 0;
    }

    .contenu {
      position: relative;
    }

    /* Transition personnalisée pour le FooterPage avec une durée de 2 secondes */
    .fade-footer-enter-active, .fade-footer-leave-active {
      transition: opacity 2s ease;
    }
    .fade-footer-enter, .fade-footer-leave-to {
      opacity: 0;
    }

    .foot {
      position: relative;
      margin-top: 20px;
      margin-bottom: 0;
    }
  }



</style>


