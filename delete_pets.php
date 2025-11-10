<?php

header('Content-Type: application/json');
include('config.php');

if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID non fourni']);
    exit;
}

$id = intval($_POST['id']); // sécurisation de l'ID

try {
    $stmt = $pdo->prepare("DELETE FROM pets WHERE pet_id = ?");
    $stmt->execute([$id]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}