class ManagerAPI {
    baseURL = 'http://localhost:80/cube3_efy/index.php'

    async getAPI(functionName, params) {
        let url = baseURL + '?functionName=' + functionName
        params.map(element=> url += '?' + element.name + '=' + element.value)
        const response = await fetch(url)
        const data = await response.json()
        return data
    }
}

export default ManagerAPI
