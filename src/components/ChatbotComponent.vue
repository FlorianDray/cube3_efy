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


       <!-- <!- CSS du chatbot --->  
 <style>

.chatbot-boxplus {
  position: fixed;
  right: 0px;
  bottom: 0px;
  z-index: 1000; /* ajoutez cette propriété pour garantir que le chatbot apparaîtra au-dessus des autres éléments */
}
.chatbot-box {
  overflow: hidden;
  transition: height 0.3s ease;
  height: 100;
}

.chatbot-box.is-open {
  height: calc(100vh - 80px); /* ajustez cette valeur en fonction de la hauteur souhaitée */
}

.page-chatbot {
  position: fixed;
  bottom: 50px;
  right: 50px;
  width: 100%;
  max-width: 400px;
  /* transition: transform 0.3s ease; */
}

.page-chatbot.is-closed {
  transform: translateY(100%);
}

/* ------BOUTON D'OUVERTURE------ */

.button-toggle-chatbox {
  position: relative;
  background: linear-gradient(90deg, rgba(35,95,255,1) 0%, rgba(45,161,245,1) 100%);
  width: 110px;
  height: 110px;
  bottom: 0;
  right: 0;
  cursor: pointer;
  border-radius: 50%;
  border: 3px solid white;
  border-bottom: none;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  transition: all 0.3s ease;
}

#bot-text {
  font-size: 12px; /* ajustez la taille du texte si nécessaire */
  font-weight: bold;
  color: white; /* changez la couleur du texte pour qu'il soit visible sur le bouton */
  margin-top: -30px; /* ajustez la marge supérieure pour positionner correctement le texte */
  padding: 5px;
}
.button-toggle-chatbox img {
  justify-content: space-evenly;
  box-sizing: border-box;
  width: 90px; /* modifiez la taille de l'image */
  float: none; /* supprimez cette propriété pour centrer l'image */
  transition: transform 0.3s ease;

}
.button-toggle-chatbox:hover img {
  transform: scale(1.1);
}


/* ------ZONE DES MESSAGES------ */
.window-chatbot {
  background-color: white;
  max-height: 600px;
  width: 500px;
  height: 600px;
  position: relative;
  display: flex;
  flex-direction: column;
  bottom: 0px;
  right: 0px;
  scroll-behavior: smooth;
  transition: height 0.3s ease-out;
  border-radius: 15px;
}
.scrollbar {
  overflow: auto;
  scrollbar-width: none;
  height: max-content;
  transition: max-height 0.2s ease-out;
  height: 700px;
}
.window-chatbot ul li {
  list-style-type: none;
  text-align: left;
  padding:0;
  margin: 0;
}
/* ------ZONE DE SAISIE DE TEXTE------ */
.input-zone {
  display: flex;
  background-color: #e7e7e7;
  padding: 10px 15px;
  border-left: 3px solid white;
  border-right: 3px solid white;
}

.input-zone input[type="text"] {
  flex-grow: 1;
  border: 1px solid #84bbf3;
  border-radius: 6px;
  padding: 10px;
  font-size: 14px;
  outline: none;
  margin-right: 10px;
}

.sendButton {
  background: linear-gradient(90deg, rgba(35,95,255,1) 0%, rgba(45,161,245,1) 100%);
  border: 1px solid #84bbf3;
  color: #ffffff;
  font-size: 15px;
  font-weight: bold;
  padding: 8px 15px;
  border-radius: 6px;
  cursor: pointer;
}

.sendButton:hover {
  background: linear-gradient(90deg, rgb(25, 69, 190) 0%, rgb(33, 118, 179) 100%);
}

.sendButton:active {
  position: relative;
  top: 1px;
}
/* ------MESSAGES USER/BOT------ */
.user {
  margin: 2px;
  padding: 15px;
  color: white;
  background: linear-gradient(90deg, rgba(35,95,255,1) 0%, rgba(45,161,245,1) 100%);   
  width: 75%;
  float: right;
  margin-right: 10px;
  margin-left: 25%;
  border-radius: 10px 10px 0px 10px;
  max-width: max-content;
  animation: floatup .5s forwards
}
.bot {
  margin: 2px;
  padding: 15px;
  color: rgb(0, 0, 0);
  background: #e0e0e0;
  width: 75%;
  float: left;
  margin-left: -30px;
  margin-right: 25%;
  border-radius: 10px 10px 10px 0px;
  animation: floatup .5s forwards
}
.bot #time {
  font-size: 10px;
  margin: 10px 0px 0px 0px;
}
.user #time {
  font-size: 10px;
  text-align: right;
  margin: 10px 0px 0px 0px;
}
/* ------ANIMATIONS------ */

@keyframes chatbot-window {
  0% { top: 700px; }
  90% { top : 700px; }
	100% { top: 0px; }
}
@keyframes floatup {
    from {
        transform: translateY(15px);
        opacity: .0;
    }
    to {
        transform: translateY(0px);
        opacity: 1;
    }
}
</style>
