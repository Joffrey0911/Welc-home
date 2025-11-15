<?php

session_start();
header('Content-Type: application/json');
include('config.php');


if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    echo json_encode([
        'success' => false,
        'message' => "Accès interdit : vous n'êtes pas administrateur"
    ]);
    exit;
}

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