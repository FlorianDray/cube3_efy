<template>
    <h2>Je suis rentré dans AllSneakers</h2>
    <div v-if="sneakers && allSneakers.length > 0">
        <ul>
            <li v-for="sneakers in allSneakers" :key="sneakers.id">
                {{ sneakers }} - {{ sneakers }} - {{ sneakers }}
            </li>
        </ul>
    </div>
    <div v-else>
        <h2>Aucune chaussure n'a été trouvé</h2>
    </div>
</template>

<script>
import { onMounted } from 'vue'
import callApi from '../APIManager'

export default {
    name: 'AllSneakers',
    data() {
        return {
            allSneakers: false
        }
    },
    async created() {
        let url = 'http://localhost:80/cube3_efy/index.php'
        const response = await fetch(url);
        const data = await response.json().then(
            // this.allSneakers = this,
            // console.log(1),
            // console.log(this.data),
            // allSneakers = this.data,
            // console.log(this.allSneakers)
        )
        console.log(2)
        console.log(data)
        console.log(this.allSneakers)
        console.log(3)
        this.allSneakers = data
        console.log(data)
        console.log(this.allSneakers)
    }
}
</script>