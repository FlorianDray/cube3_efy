export default class ManagerAPI {

  baseURL = 'http://localhost:80/cube3_efy/index.php'

  /**
   * Appel API en méthode HTTP GET
   * @param {string} functionName Nom de la fonction visé dans index.php
   * @param {array} params Paramètre de requête - Chaque param nécessite un objet clé + valeur
   * @returns  {array} Retour API
   */
  async getAPI(functionName, params = '') {
    let url = this.baseURL + '?functionName=' + functionName; //Construction minimal d'une url
    if (params.length > 0) { //Ajout des paramètres dans l'url
      params.map(element => url += '&' + element.name + '=' + element.value);
    }
    const response = await fetch(url, {
    }); //Fetch sur le fichier index.php
    const data = await response.json(); // Réception de la réponse
    return data; //Renvoi de la réponse
  }
}

