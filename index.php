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
    // $temp = $conn->prepare($query);
    $temp = $conn->prepare('SELECT * FROM sneakers');
    $temp->execute();
    $items = $temp->fetchAll();
    if(!isset($items) || empty($items)) {
        return json_encode(false);
    }
    else {
        return json_encode($items);
    }
}

function getAllSneakers(){
    $select = 's.id, s.size, s.price, s.img_path, c.name as color, b.name as brand';
    $from = 'sneakers s';
    $join = 'brand b ON s.id_brand = b.id AND colors c ON s.id_color = c.id';
    $query = "SELECT $select FROM $from INNER JOIN $join";
    echo  makeQuery($query);
}



echo getAllSneakers();



