<template>
  <div class="carousel">
    <div class="pic-ctn">
      <div class="pic"></div>
      <div class="pic"></div>
      <div class="pic"></div>
      <div class="pic"></div>
      <div class="pic"></div>
    </div>
  </div>
</template>

<script setup>
// Aucune logique supplémentaire n'est nécessaire
</script>

<style lang="scss">
.carousel {
  @keyframes display {
    0% {
      transform: translateX(200px);
      opacity: 0;
    }

    10% {
      transform: translateX(0px);
      opacity: 1;
    }

    20% {
      transform: translateX(0px);
      opacity: 1;
    }

    30% {
      transform: translateX(-200px);
      opacity: 0;
    }

    100% {
      transform: translateX(-200px);
      opacity: 0;
    }
  }

  .pic-ctn {
    width: 100%;
    height: 300px;
    position: relative;

    .pic {
      width: 100%;
      height: 300px;
      background-image: url('https://wash-totalenergies.fr/wp-content/uploads/2023/05/auto-1822415_1280.jpg');
      position: absolute;
      top: 0;
      // left: calc(50% - 200px); /* Correction pour centrer correctement */
      opacity: 0;
      animation: display 10s infinite;
      background-position: center;
      /* Centre l'image */
      background-size: cover;
      /* L'image couvre toute la div en gardant son ratio */
      background-repeat: no-repeat;
      /* Empêche la répétition de l'image */
    }

    /* Ajouter des délais distincts pour chaque image */
    .pic:nth-child(1) {
      animation-delay: 0s;
    }

    .pic:nth-child(2) {
      animation-delay: 2s;
      background-image: url('https://media.roole.fr/_next/image?url=https%3A%2F%2Fassets.prod.roole.fr%2Fdata%2Fassets%2Flavage_auto_7830255252.jpg&w=3840&q=75');
    }

    .pic:nth-child(3) {
      animation-delay: 4s;
      background-image: url('https://www.protegez-vous.ca/var/protegez_vous/storage/images/5/9/0/0/5760095-1-fre-CA/lavage.jpg');
    }

    .pic:nth-child(4) {
      animation-delay: 6s;
      background-image: url('https://wash-totalenergies.fr/wp-content/uploads/2022/10/je-veux-laver-nettoyage-interieur-nettoyage-des-sieges-1.jpg');
    }

    .pic:nth-child(5) {
      animation-delay: 8s;
      background-image: url('https://www.delcourt.fr/img/cms/lavage-auto-quebec.jpg');
    }
  }
}
</style>