<script>

// Importer les fonctions nécessaires à partir du module chatHelper
import { getTime, getCategories, getProducts, } from '../helpers/chatHelper';
// Créer et exporter un composant Vue.js nommé ChatbotComponentv2 pour récupérer ses données.
export default {
  name: 'ChatbotComponent',
  props: {
    msg: String
  },
  // Initialiser les données de dialogue avec un message de bienvenue du bot
  data() {
    return {
      dialog: [{
        msg: 'Bonjour ! Que puis-je faire pour vous ?',
        user: 'bot',
        time: '',
        
      }],
      userMessage: "", // Ajouter une nouvelle propriété pour stocker le message de l'utilisateur
      isChatbotOpen: false, // État pour afficher ou masquer le chatbot

    }
  },

  methods: {
    // Méthode pour basculer l'état d'affichage du chatbot
    toggleChatbot() {
      this.isChatbotOpen = !this.isChatbotOpen;
    },
    // Méthode pour envoyer le message de l'utilisateur et mettre à jour le dialogue
    sendMessage() {
      if (this.userMessage.trim()) {
      this.addMessage(this.userMessage, 'user');
      const botReply = this.botResponse(this.userMessage, this.dialog);
      this.addMessage(botReply, 'bot');
      this.userMessage = '';
      this.scrollToBottom();
    }
  },
    // Méthode pour ajouter un message dans la boite de dialogue
    addMessage(message, user) {
    this.dialog.push({
      msg: message,
      user: user,
      time: getTime(),
    });
  },
    // Personnalisez les réponses du chatbot ici
    botResponse(userMessage,) {
      switch (userMessage.toLowerCase()) {
        case 'bonjour':
          return ("Bonjour et bienvenue !");
        case 'homme':
          return getCategories('type');
        case 'femme':
          return getCategories('type');
        case 'nom':
          return getCategories('nom');
        case 'couleur':
          return getCategories('couleurs');
        case 'taille':
          return getCategories('taille');
        case 'nike':
          return getProducts('nike', 'marque');
        default:
          return "Je n'ai pas compris. Veuillez réessayer.";
      }
    },
    // Fonction qui permet de défiler vers le bas automatiquement la boite de dialogue
    scrollToBottom() {
      this.$nextTick(() => {
        this.$refs.scrollArea.scrollTop = this.$refs.scrollArea.scrollHeight;
      });
    },
  }
}
</script>

<template>

    <!-- Le conteneur du chatbot, qui sera affiché ou masqué en fonction de l'état isChatbotOpen -->
 <div class="page-chatbot" :class="{ 'is-closed': !isChatbotOpen }">
    <!-- Le bouton pour afficher ou masquer le chatbot -->
    <div class="chatbot-boxplus">
    <div class="chatbot-box" :class="{ 'is-open': isChatbotOpen }">
      <div id="button-chatbox">
        <button type="button" class="button-toggle-chatbox" @click="toggleChatbot()">
          <img class="chat-bar-icons-2" src="../assets/images/bot_logo.png">
          <p id="bot-text" v-if="!isChatbotOpen">Chat avec Sneak Me !</p>
          <p id="bot-text" v-if="isChatbotOpen">Fermer</p>
        </button>
      </div>
    <!-- La fenêtre du chatbot -->
      <div class="window-chatbot" v-if="isChatbotOpen">
    <!-- Afficher la liste des messages de dialogue -->
        <ul class="scrollbar" ref="scrollArea">
          <li v-for="message in dialog">
            <div class="userBox">
              <p :class="message.user == 'bot' ? 'bot' : 'user'">{{ message.msg }}<p id="time">{{ message.time }}</p></p>
            </div>
          </li>
        </ul>
        <div class="input-zone">
          <input type="text" v-model="userMessage" @keyup.enter="sendMessage" />
          <button @click="sendMessage" class="sendButton">Envoyer</button>
        </div>
      </div>
    </div>
    </div>
  </div>
</template>
