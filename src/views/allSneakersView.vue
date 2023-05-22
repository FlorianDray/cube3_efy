<script>
import ManagerAPI from '../ManagerAPI';


  export default {
    name: 'allSneakersView',
    data(){
        return {
            allSneakers: [],
        }
    },
    async created(){ 
        let papillon = new ManagerAPI()
        this.allSneakers = papillon.getAPI('getAllSneakers')
    }
  }
</script>

<template>
 <section v-if="this.allSneakers.length > 0 ">
    <div v-for="sneakers of this.allSneakers" :key="sneakers.id">
        <p>{{ sneakers.price }}</p>
        <p>{{ sneakers.size }}</p>
    </div>
 </section>
 <section v-else>
        <p>Pas de résultats !</p>
 </section>
</template>