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
import ManagerAPI from '../ManagerAPI'

export default {
    name: 'AllSneakers',
    data() {
        return {
            allSneakers: []
        }
    },
    async created() {
        let MANAGER = new ManagerAPI()
        let params = [
            {name : 'id_sneakers', value : 2}
        ]
        this.allSneakers = MANAGER.getAPI('getOneSneakers', params)
    }
}
</script>