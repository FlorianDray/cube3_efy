<script setup>
import callApi from '../APIManager'
let params = {
    httpMethod: 'GET',
    functionName: 'getAllSneakers()'
}

const allSneakers = callApi()
console.log(allSneakers )
</script>

<template>
    <h2>Je suis rentré dans AllSneakers</h2>
    <div v-if="sneakers && sneakers.length > 0">
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