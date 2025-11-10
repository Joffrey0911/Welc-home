<?php

session_start();

// Vérifie si l'utilisateur est connecté et est un user
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 0) {
    // Redirige vers la page de connexion si pas connecté
    header('Location: login.html');
    exit();
}

// L'utilisateur est connecté, tu peux afficher ses informations
$nom = $_SESSION['user_name'];  // par exemple
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Utilisateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Bienvenue, <?php echo htmlspecialchars($nom); ?> !</h2>
        <p>Voici votre dashboard utilisateur.</p>

        <a href="logout.php" class="btn btn-danger">Déconnexion</a>
    </div>
</body>
</html>
