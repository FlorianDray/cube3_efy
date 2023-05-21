<template>
  <form @submit.prevent="checkForm">
    <label for="mail">Mail :</label>
    <input type="mail" id="mail" name="mail" v-model="this.mail" required><br><br>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" v-model="this.password" required><br><br>
    <input type="submit" value="Se connecter">
  </form>
  <div v-if="validation" class="modal" :class="{ success: validation.success }">
    <p>{{ validation.message }}</p>
  </div>
</template>
  
<script>
import ManagerAPI from '../ManagerAPI'
import { reactive } from 'vue'
export default {
  name: 'userConnect',
  data() {
    return {
      manager: new ManagerAPI(),
      password: '',
      mail: '',
      errors: [],
      validation: null
    }
  },
  methods: {
    async checkForm() {
      if (!this.mail) {
        this.errors.push('Le mail est requis.')
      } else if (!this.password) {
        this.errors.push('Le mot de passe est requis.')
      } else {
        let params = [
          {
            name: 'mail',
            value: this.mail
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
        const userConnect = await this.manager.getAPI('connectUser', params)
        this.validation = { success: true, message: 'Connexion réussi' }
      } catch (error) {
        console.log(error)
        this.validation = { success: false, message: 'Connexion échoué' }
      }
    },
  }
}
</script>