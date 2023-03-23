export default class ManagerAPI {
    baseURL = 'http://localhost:80/cube3_efy/index.php'

    async getAPI(functionName, params) {
        let url = this.baseURL + '?functionName=' + functionName
        if(params.length > 0){
            params.map(element=> url += '&' + element.name + '=' + element.value)
        }
        console.log(url)
        const response = await fetch(url)
        console.log(response)
        const data = await response.json()
        console.log(data)
        return data
    }
}
