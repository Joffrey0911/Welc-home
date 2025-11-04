<?php



session_start();

include 'config.php';
?>

<?php

$error = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupération des champs du formulaire
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);

    // Prépare la requête SQL
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 

    
    if ($user) {
        // Vérifie le mot de passe haché
        if (password_verify($password, $user['pass'])) {

            // Stocke les infos en session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role_id'];


            // Redirige vers le dashboard
            header("Location: dashboard_admin.php");
            exit;
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Aucun compte trouvé avec cet email.";
    }
}



?>
                    
<?php if($error): ?>
    <div class="alert alert-danger text-center"><?= $error ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Welc'home</title>
</head>
<body>

    <header class="container-fluid">
                <h1 class='d-flex justify-content-center'>Welc'home</h1>
                <div class="pictureBear d-flex justify-content-center align-items-center position-relative mb-2">
                    <img src="assets/ai-generated-8577262_640.png" alt="image d'ours" class='position-absolute start-0'>
                </div>
                <nav class='container d-flex justify-content-end align-items-center py-3 d-grid gap-2'>
                    <a href='main.php' class="btn btn-outline-primary">Accueil</a>
                </nav>
            </header>
            
    <main class="container my-5">
        <h2 class="text-center mt-2">Connexion utilisateur</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <form id='form_connexion'method="POST" class="d-grid gap-3">
                    <input class="form-control border border-primary rounded" name="email" id="email" type="email" placeholder="Entrez votre email" required>
                    <input class="form-control border border-primary rounded" name="pass" id="pass" type="password" placeholder="Entrez votre mot de passe" required>

                    <button class="btn btn-outline-primary" type="submit">Valider</button>
                </form>
            </div>
        </div>
    </main>


</body>
</html>


                    

            
            
        
            
        
