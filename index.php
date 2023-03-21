<?php
const HOST = 'localhost';
const DB_NAME = 'sneak_me';
const USERNAME = 'sylphe';
const PWD = 'Sylphe0597!';

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
    $temp = $conn->prepare('SELECT * FROM sneakers');
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
    $join = 'INNER JOIN brands b ON s.id_brand = b.id AND colors c ON s.id_color = c.id';
    $orderBY = 's.id DESC';
    $query = "SELECT DISTINCT $select FROM $from $join ORDER BY $orderBY";
    echo  makeQuery($query);
}



echo getAllSneakers();



