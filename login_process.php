<?php
session_start();
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 0);
include 'config.php';

$response = ['success' => false, 'message' => 'Email ou mot de passe incorrect'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'], $_POST['pass'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);

    if (empty($email) || empty($password)) {
        $response['message'] = 'Tous les champs sont requis';
    } else {
        $user = null;
        $role_id = null;

        // 1️⃣ Cherche dans admins
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($admin && password_verify($password, $admin['pass'])) {
            $user = $admin;
            $role_id = 1; // admin
        } else {
            // 2️⃣ Cherche dans users
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $usr = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usr && password_verify($password, $usr['pass'])) {
                $user = $usr;
                $role_id = 0; // user
            }
        }

        if ($user) {
            // Stocke les infos en session
            $_SESSION['user_id'] = $user['user_id'] ?? $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'] ?? $user['nom'] ?? 'Utilisateur';
            $_SESSION['role_id'] = $role_id;

            $response = [
                'success' => true,
                'role_id' => $role_id
            ];
        }
    }
}

echo json_encode($response);
exit;

            
            
        