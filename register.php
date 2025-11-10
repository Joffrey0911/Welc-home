<?php

session_start();
header('Content-Type: application/json');
include('config.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['user_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['pass'] ?? '';

    if (!$nom || !$email || !$password) {
        echo json_encode(['success' => false, 'error' => 'Tous les champs sont requis.']);
        exit;
    }

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'error' => 'Email déjà utilisé.']);
        exit;
    }

    // Hash du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // role_id = 0 pour un utilisateur classique
    $stmt = $pdo->prepare("INSERT INTO users (nom, email, pass, role_id) VALUES (?, ?, ?, 0)");
    if ($stmt->execute([$nom, $email, $hashedPassword])) {

         $user_id = $pdo->lastInsertId();

        
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $nom;
        $_SESSION['role_id'] = 0;
        echo json_encode([
        "success" => true,
        "message" => "Connexion réussie",
        "role_id" => 0
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'inscription.']);
    }
}
