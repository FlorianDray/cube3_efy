<script>
import ManagerAPI from '../ManagerAPI'

export default {
    name: 'OneSneakerView',
    data() {
        return {
            oneSneakers: [],
            params: [
                { 
                    name:'id_sneakers',
                    value: this.$route.params.id, // Récupérer l'ID de sneakers depuis l'URL
                }
            ]
        }
    },
    async created() {
  let manager = new ManagerAPI()
  const sneakerId = this.$route.params.id;
  this.params[0].value = sneakerId;
  this.oneSneakers = await manager.getAPI('getOneSneakers', this.params)
    }
}
</script>

<template>
  <div class="sneaker">
    <img :src="oneSneakers.img_path" alt="Sneaker Image" />
    <h3>{{ oneSneakers.name }}</h3>
    <p>{{ oneSneakers.description }}</p>
    <p>Taille: {{ oneSneakers.size }}</p>
    <p>Prix: {{ oneSneakers.price }} €</p>
    <button @click="addToCart">Ajouter au panier</button>
  </div>

</template>

<style>
.sneaker {
  background-color: #fff;
  border: 1px solid #e6ecf0;
  border-radius: 10px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
  display: inline-block;
  margin: 10px;
  padding: 20px;
  width: 300px;
}

.sneaker img {
  max-width: 100%;
  height: auto;
  display: block;
  margin-bottom: 15px;
}

.sneaker h3 {
  color: #1d2129;
  font-size: 20px;
  font-weight: 600;
  margin: 0 0 10px;
}

.sneaker p {
  color: #1d2129;
  font-size: 14px;
  margin: 0 0 10px;
}

.sneaker button {
  background-color: #007bff;
  border: none;
  border-radius: 20px;
  color: #fff;
  cursor: pointer;
  font-size: 14px;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 5px 2px;
  transition-duration: 0.4s;
}

.sneaker button:hover {
  background-color: #0069d9;
  color: white;
}
</style>