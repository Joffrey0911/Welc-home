<?php
session_start();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0); // Empêche l'affichage des warnings

include 'config.php';

// Réponse par défaut
$response = ['success' => false, 'message' => 'Une erreur est survenue'];

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'], $_POST['pass'])) {

        $email = trim($_POST['email']);
        $password = trim($_POST['pass']);

        if (empty($email) || empty($password)) {
            $response['message'] = 'Tous les champs sont requis';
        } else {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['pass'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role_id'];

                $response = ['success' => true];
            } else {
                $response['message'] = 'Email ou mot de passe incorrect';
            }
        }
    } else {
        $response['message'] = 'Méthode non autorisée';
    }
} catch (Exception $e) {
    $response['message'] = 'Erreur serveur';
}

// Toujours renvoyer du JSON propre
echo json_encode($response);
exit;


                    

            
            
        