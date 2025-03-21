<template>
      <div class="footer">
        <p>&copy; 2024 LEDAX CAR SHINE. Tous droits réservés. | <a  @click="sendValue('mention')" >mentions légales</a></p>
    </div>
</template>

<script>
export default {
    name: "FooterPage",
    methods: {
    sendValue(value) {
      // Émet un événement avec la valeur du bouton cliqué à la vue parente
      this.$emit('changement', value);
    }
  }
}
</script>

<style>
    .footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        width: 100%;
        bottom: 0;
    }

    .footer a {
        color: #ffcc00;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }
</style>