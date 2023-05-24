<script>

// Importer les fonctions nécessaires 
import { getTime,  } from '../helpers/chatHelper';

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
        msg: 'Bonjour ! Pour commencer votre recherche dite "bonjour" !',
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
        // Méthode pour envoyer directement un message au bot au clic des mots clés
        sendKeyword(keyword) {
    this.addMessage(keyword, 'user');
    const botReply = this.botResponse(keyword, this.dialog);
    this.addMessage(botReply, 'bot');
    this.scrollToBottom();
  },
    // Personnalisez les réponses du chatbot ici
    botResponse(userMessage) {
  const lowerCaseMessage = userMessage.toLowerCase();
  switch (lowerCaseMessage) {
    case 'bonjour':
    return `Bonjour et bienvenue ! <br><br> Vous pouvez triez les sneakers avec les mots suivants :  <span class='highlights' @click="sendMessage('marques')">marques</span>, <span class='highlights' @click="sendMessage('couleurs')">couleurs</span>, <span class='highlights' @click="sendMessage('tailles')">tailles</span> et <span class='highlights' @click="sendMessage('genre')">genre</span>. <br><br> Pour tout afficher : <span class='highlights' @click="sendMessage('sneakers')">sneakers</span>.`;
      
    case 'marques':
    return `Voici les différentes<br><router-link to="/brands" class="highlight">Marques</router-link> <br> . <router-link to="/brands/nike" class="highlight">Nike</router-link> <br> . <router-link to="/brands/adidas" class="highlight">Adidas</router-link> <br> . <router-link to="/brands/puma" class="highlight">Puma</router-link> <br> . <router-link to="/brands/reebok" class="highlight">Reebok</router-link> <br> . <router-link to="/brands/converse" class="highlight">Converse</router-link> <br> . <router-link to="/brands/vans" class="highlight">Vans</router-link>`;

    case 'couleurs':
      return `Voici les différentes<br><router-link to="/colors" class="highlight">Couleurs</router-link> <br> . <router-link to="/colors/red" class="highlight">Rouge</router-link> <br> . <router-link to="/colors/blue" class="highlight">Bleu</router-link> <br> . <router-link to="/colors/black" class="highlight">Noir</router-link> <br> . <router-link to="/colors/white" class="highlight">Blanc</router-link> <br> . <router-link to="/colors/green" class="highlight">Vert</router-link>`;
      
    case 'tailles':
    return `Voici les différentes<br><router-link to="/sizes" class="highlight">Tailles</router-link> <br> . <router-link to="/size/37" class="highlight">37</router-link> <br> . <router-link to="/size/38" class="highlight">38</router-link> <br> . <router-link to="/size/39" class="highlight">39</router-link> <br> . <router-link to="/size/40" class="highlight">40</router-link> <br> . <router-link to="/size/41" class="highlight">41</router-link> <br> . <router-link to="/size/42" class="highlight">42</router-link><br> . <router-link to="/size/43" class="highlight">43</router-link><br> . <router-link to="/size/44" class="highlight">44</router-link>`;
      
    case 'genre':
    return `Voici les différents<br><router-link to="/gender" class="highlight">Genres</router-link> <br> . <router-link to="/sneakers/men" class="highlight">Homme</router-link> <br> . <router-link to="/sneakers/women" class="highlight">Femme</router-link> <br> . <router-link to="/sneakers/unisex" class="highlight">Unisexe</router-link>`;
      
    // Ajouter d'autres marques si nécessaire
    
    case 'tailles':
      return "Nous avons des sneakers disponibles en tailles : 36, 37, 38, 39, 40, 41, 42, 43, 44, 45 et 46.";
      
    case 'taille 42':
      return "Voici quelques sneakers en taille 42 : \n 1. Nike Air Max 270 React (ID: 1) \n 2. Adidas Yeezy Boost 350 V2 (ID: 2) \n 3. Puma RS-X Reinvention (ID: 3) \n 4. Reebok Zig Kinetica (ID: 4)";
      
    // Ajouter d'autres tailles si nécessaire
    
    default:
      if (lowerCaseMessage.startsWith("voir ")) {
        const productId = lowerCaseMessage.replace("voir ", "").trim();
        return `Cliquez sur ce lien pour voir les sneakers demandées : ${getProductURL(productId)}`;
      } else {
        return "Je n'ai pas compris. Veuillez réessayer.";
      }
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
              <div :class="message.user == 'bot' ? 'bot' : 'user'" v-html="message.msg" @keyword-click="sendKeyword">
              </div>
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
