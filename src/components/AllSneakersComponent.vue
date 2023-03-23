<template>
    <section v-if="this.allSneakers.length > 0" class="section_allSneakers">
        <div class="card_sneakers" v-for="sneakers of this.allSneakers" :key="sneakers.id">
            <div class="card_sneakers_namePrice">
                <h3> Nom </h3>
                <text> {{ sneakers.price  + '€'}} </text>
            </div> 
            <img class="img_card_sneakers" src="/src/assets/bot_logo.png">            
        </div>
    </section>
</template>

<script>
import ManagerAPI from '../ManagerAPI'

export default {
    name: 'AllSneakersComponent',
    data() {
        return {
            allSneakers: []
        }
    },
    async created() {
        let manager = new ManagerAPI()
        this.allSneakers = await manager.getAPI('getAllSneakers')
    }
}
</script>