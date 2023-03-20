const callApi = (httpMethod, params) => {
  let url = '"http://localhost:5173/index.php'

  fetch(url, {
    method: httpMethod,
    // headers: {
    //   'Content-Type': 'multipart/form-data'
    // },
    body: JSON.stringify(params),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Success:", data)
      return data
    })
    .catch((error) => {
      console.log(error)
      return false
    });
}

export default callApi