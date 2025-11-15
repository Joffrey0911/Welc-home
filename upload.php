<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
include 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){

if (!isset($_FILES['photo'])) {
    echo json_encode(["success" => false, "message" => "Aucun fichier reçu"]);
    exit;
}

$uploadDir = "assets/uploads/";
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

$file = $_FILES['photo'];
$tmp = $file['tmp_name'];
$name = uniqid() . "_" . $file['name'];
$path = $uploadDir . $name;

if (!move_uploaded_file($tmp, $path)) {
    echo json_encode(["success" => false, "message" => "Impossible d'enregistrer l'image."]);
    exit;
} 


$stmt = $pdo->prepare("INSERT INTO users (photo, user_id)VALUES (:photo, :user_id)");
if (!$stmt->execute([$path, $userId])) {
    echo json_encode(["success" => false, "message" => "Impossible de mettre à jour la base de données."]);
    exit;
}


$stmt2 = $pdo->prepare("SELECT photo FROM users WHERE id = ?");
$stmt2->execute([$userId]);
$user = $stmt2->fetch();

}


echo json_encode([
    "success" => true,
    "path" => $user['photo']
]);
exit;