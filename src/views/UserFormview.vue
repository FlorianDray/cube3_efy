<template>
  <form @submit.prevent="checkForm">
    <label for="last_name">Nom :</label>
    <input type="text " id="last_name" name="last_name" v-model="this.last_name" required><br><br>
    <label for="first_name">Prénom :</label>
    <input type="text" id="first_name" name="first_name" v-model="this.first_name" required><br><br>
    <label for="adress">Adresse :</label>
    <input type="text" id="adress" name="adress" v-model="this.adress" required><br><br>
    <label for="mail">Mail :</label>
    <input type="mail" id="mail" name="mail" v-model="this.mail" required><br><br>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" v-model="this.password" required><br><br>
    <label for="confirm_password">Confirmez le mot de passe :</label>
    <input type="password" id="confirm_password" name="confirm_password" v-model="this.confirm_password" required><br><br>
    <input type="submit" value="S'inscrire">
  </form>
  <div v-if="validation" class="modal" :class="{ success: validation.success }">
    <p>{{ validation.message }}</p>
  </div>
</template>

<script>
import ManagerAPI from '../ManagerAPI'
export default {
  name: 'UserView',
  data() {
    return {
      manager : new ManagerAPI(),
      confirm_password: '',
      first_name: '',
      last_name: '',
      password: '',
      mail: '',
      adress: '',
      errors: [],
      validation: null
    }
  },
  methods: {
    async checkForm() {
      if (!this.last_name) {
        this.errors.push('Le nom est requis.')
      } else if (!this.first_name) {
        this.errors.push('Le prénom est requis.')
      } else if (!this.adress) {
        this.errors.push('L\'adresse est requise.')
      } else if (!this.mail) {
        this.errors.push('Le mail est requis.')
      } else if (!this.password || this.password != this.confirm_password) {
        this.errors.push('Le mot de passe n\'est pas valide.')
      } else {
        let params = [
          {
            name: 'last_nam',
            value: this.last_name
          },
          {
            name: 'first_name',
            value: this.first_name
          },
          {
            name: 'mail',
            value: this.mail
          },
          {
            name: 'adress',
            value: this.adress
          },
          {
            name: 'password',
            value: this.password
          }
        ]
        await this.submit(params)
      }
    },
    async submit(params) {
      try {
        await this.manager.getAPI('addUser', params)
        this.validation = { success: true, message: 'Utilisateur ajouté avec succès' }
      } catch (error) {
        console.log(error)
        this.validation = { success: false, message: 'Une erreur est survenue lors de l\'ajout de l\'utilisateur' }
      }
    },
  }
}
</script>