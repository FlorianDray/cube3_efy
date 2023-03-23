<?php
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

//Récupération de toutes les sneakers en fonctions d'un id
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


