<?php

header('Content-Type: application/json');
include('config.php');

$query = $pdo->query("SELECT pet_id AS id, nom AS name, type, genre AS gender FROM pets ORDER BY id DESC");
$pets = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($pets, JSON_UNESCAPED_UNICODE);


