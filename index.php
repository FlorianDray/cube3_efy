<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require './env.php';

// Réception d'une requête HTTP
if (isset($_REQUEST['functionName'])) {
    $functionName = $_REQUEST['functionName'];
    if (function_exists($functionName)) {//Vérification de l'existence de la fonction
        $functionName();//Lancement de la fonction
    } else {
        echo json_encode('La fonction n\'existe pas :' . $functionName );
    }
}

//Connexion à la BDD
function DBconnect(){
    try { //Essaie de connexion
        $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USERNAME, PWD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) { //Sinon retour d'erreur
        echo "Connection Error: " . $e->getMessage();
    }
}

//Execution de requêtes
function makeQuery($query){
    $conn = DBconnect(); //Création de la connection
    $temp = $conn->prepare($query); //Préparation de la requête
    $temp->execute();//Exécution de la requête
    $items = $temp->fetchAll(PDO::FETCH_CLASS); //Récupération des résultats
    if(!isset($items) || empty($items)) { //Retour en fonction de ce que renvoi la requête
        return json_encode(false);
    }
    else {
        return json_encode($items);
    }
}

//Récupération de toutes les sneakers
function getAllSneakers(){
    //Création de la requête
    $select = 's.id AS id,  s.size AS size, s.price AS price, s.img_path AS img_path, c.name AS color, b.name AS brand';
    $from = 'sneakers s';
    $join = 'INNER JOIN brands b ON s.id_brand = b.id INNER JOIN colors c ON s.id_color = c.id';
    $orderBY = 's.id DESC';
    $query = "SELECT $select FROM $from $join ORDER BY $orderBY;";
    echo  makeQuery($query); //Execution de la requête
}

//Récupération de toutes les sneakers en fonction d'un id
function getOneSneakers(){
    //Création de la requête
    $id = $_REQUEST['id_sneakers'];
    $select = 's.id AS id,  s.size AS size, s.price AS price, s.img_path AS img_path, c.name AS color, b.name AS brand ';
    $from = ' sneakers s ';
    $join = ' INNER JOIN brands b ON s.id_brand = b.id INNER JOIN colors c ON s.id_color = c.id ';
    $where = " s.id = $id ";
    $query = "SELECT $select FROM $from $join WHERE $where;";
    echo  makeQuery($query);  //Execution de la requête
}

//Récupération d'un panier utilisateur en fonction d'un id
function getUserCarts(){
    //Création de la requête
    $id_user = $_REQUEST['id_user'];
    $from = ' carts ';
    $where = " id_user = $id_user";
    $query = "SELECT DISTINCT * FROM $from WHERE $where;";
    echo  makeQuery($query);  //Execution de la requête
}

//Création d'une association produit/panier utilisateur
function addToCart(){
    $id_product = $_REQUEST['id_product'];
    $id_user = $_REQUEST['id_user'];
    $quantity = $_REQUEST['id_user'];
    $table = 'carts';
    $query = "INSERT INTO $table VALUES($id_user, $id_product, $quantity)";
    echo  makeQuery($query);  //Execution de la requête
} 

//Suppression d'une association produit/panier utilisateur
function deleteFromCart(){
    $id_product = $_REQUEST['id_product'];
    $id_user = $_REQUEST['id_user'];
    $table = 'carts c';
    $where = "c.id_user = $id_user AND c.id_sneaker = $id_product";
    $query = "DELETE FROM $table WHERE $where;";
    echo  makeQuery($query);  //Execution de la requête
}

//Modifications d'une association produit/panier utilisateur
function updateFromCart(){
    $id_product = $_REQUEST['id_product'];
    $id_user = $_REQUEST['id_user'];
    $quantity = $_REQUEST['quantity'];
    $table = 'carts c';
    $where = "c.id_user = $id_user AND c.id_sneaker = $id_product";
    $query = "UPDATE $table SET quantity = $quantity  WHERE $where;";
    echo  makeQuery($query);  //Execution de la requête
}