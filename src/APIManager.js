const callApi = () => {
    let url ='http://localhost:80/cube3_efy/index.php';
    // let url = 'http://localhost:80/index.php'
    fetch(url)
        .then(response => response)
        .then(data => console.log(data))
        .catch(error => console.error(error))
}
export default callApi