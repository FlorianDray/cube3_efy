<template>
    <h2>Je suis rentré dans AllSneakers</h2>
    <div v-if="allSneakers.length > 0">
        <ul>
            <li v-for="sneakers in allSneakers" :key="sneakers.id">
                {{ sneakers.id }}
            </li>
        </ul>
    </div>
    <div v-else>
        <h2>Aucune chaussure n'a été trouvé</h2>
    </div>
</template>

<script>
import { onMounted } from 'vue'
// import callApi from '../APIManager'
import ManagerAPI from '../ManagerAPI'

export default {
    name: 'AllSneakers',
    data() {
        return {
            allSneakers: []
        }
    },
    async created() {
        // this.allSneakers = await callApi()
        let ManagerAPI = new ManagerAPI()
        let params = [
            ['name' = id, 'value' = 2]
        ]

        this.allSneakers = ManagerAPI.getAPI('getAllSneakers', params)
    }
}
</script>