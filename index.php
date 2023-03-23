<?php
require './env.php';

function DBconnect(){
    try {
        $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USERNAME, PWD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
    }
}

function makeQuery($query){
    $conn = DBconnect();
    $temp = $conn->prepare($query);
    $temp->execute();
    $items = $temp->fetchAll(PDO::FETCH_CLASS);
    if(!isset($items) || empty($items)) {
        return json_encode(false);
    }
    else {
        return json_encode($items);
    }
}

function getAllSneakers(){
    $select = 's.id AS id,  s.size AS size, s.price AS price, s.img_path AS price, c.name AS color, b.name AS brand';
    $from = 'sneakers s';
    $join = 'INNER JOIN brands b ON s.id_brand = b.id INNER JOIN colors c ON s.id_color = c.id';
    $orderBY = 's.id DESC';
    $query = "SELECT $select FROM $from $join ORDER BY $orderBY;";
    echo  makeQuery($query);
}

function getOneSneakers($id){
    $select = 's.id AS id,  s.size AS size, s.price AS price, s.img_path AS price, c.name AS color, b.name AS brand ';
    $from = ' sneakers s ';
    $join = ' INNER JOIN brands b ON s.id_brand = b.id INNER JOIN colors c ON s.id_color = c.id ';
    $where = " s.id = $id ";
    $query = "SELECT $select FROM $from $join WHERE $where;";
    echo  makeQuery($query);
}
http://localhost:80/cube3_efy/index.php?functionName=getOneSneakers&id_sneakers=2
if (isset($_REQUEST['functionName'])) {
    // var_dump($_REQUEST);
    // var_dump($_REQUEST['functionName']);
    // echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>';echo '<pre>';
    // var_dump($_SERVER);
    // echo '</pre>';
    $functionName = $_REQUEST['functionName'];
    var_dump($functionName);
    echo json_encode($_REQUEST['id_sneakers']);
    if (function_exists($functionName)) {
        // echo json_encode($_REQUEST['id_sneakers']);
        switch ($functionName) {
            // getOneSneakers
            case 'getAllSneakers':
                getAllSneakers();
            case 'getOneSneakers':
                $id_sneakers = $_REQUEST['id_sneakers'];
                if($id_sneakers && $id_sneakers) {
                    echo json_encode($id_sneakers);
                    getOneSneakers($_REQUEST['id_sneakers']);
                } else {
                    echo json_encode('Paramètre id_sneakers invalide');
                }
            default:
                echo json_encode('Fonction non prise en charge');
        }
    } else {
        echo json_encode('La fonction n\'existe pas :' . $functionName );
    }
}
// echo getOneSneakers(2);
// if(isset($_POST) || isset($_GET)){
//     $varHttp = $_REQUEST['method'];
// }
// echo getOneSneakers(2);