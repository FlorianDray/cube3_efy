const callApi = async () => {
    let url = 'http://localhost:80/cube3_efy/index.php'
    const response = await fetch(url);
    const data = await response.json()
    return data
}
export default callApi