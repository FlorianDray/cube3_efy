<template>
    <h2>Je suis rentré dans AllSneakers</h2>
    <div v-if="!sneakers || allSneakers.length > 0">
        <ul>
            <li v-for="sneakers in allSneakers" :key="sneakers.id">
                {{ sneakers.name }} - {{ sneakers.brand }} - {{ sneakers.price }}
            </li>
        </ul>
    </div>
    <div v-else>
        <h2>Aucune chaussure n'a été trouvé</h2>
    </div>
</template>

<script>
import callApi from '../APIManager'

export default {
    name: 'AllSneakers',
    data() {
        return {
            allSneakers: false
        }
    },
    async created() {
        const response = callApi()
        const { data: allSneakers } = await response.json()
        this.allSneakers = allSneakers
    }
}
</script>