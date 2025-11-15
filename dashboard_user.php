<?php

session_start();




// Vérifie si l'utilisateur est connecté et est un user
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 0) {
    // Redirige vers la page de connexion si pas connecté
    header('Location: login.html');
    exit();
}

// L'utilisateur est connecté, tu peux afficher ses informations
$nom = $_SESSION['username'];  // par exemple
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DynaPuff:wght@400..700&display=swap" rel="stylesheet">
    <script>
    const userRole = <?= isset($_SESSION['role_id']) ? (int)$_SESSION['role_id'] : 0 ?>;
    </script>

    <title>Dashboard Utilisateur</title>
    
</head>
<body id='user_page'>
    <!--<header class='container-fluid'>
        <div class="container d-flex justify-content-center mt-5">
            <h1 class="d-flex justify-content-center mb-4">Welc'home</h1>
        </div>
        <div class='container d-flex justify-content-end'>
            <nav class='d-flex flex-column flex-md-row gap-2'>
                <a href="login.php" class="btn">Accueil</a>
                <a href="login.php" class="btn">Liste des animaux</a>
                <a href="register.html" class="btn">Contact</a>
                <a href="login.html" class="btn">Deonnexion</a>
            </nav>
        </div>-->
     <header class="container-fluid" id="user_header">
  <h1 class="d-flex justify-content-center mb-4">Welc'home</h1>

  <nav class="navbar navbar-expand-md p-0">
    <div class="container-fluid d-flex align-items-center">
      
     
      
      <button class="navbar-toggler d-md-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarButtons"
        aria-controls="navbarButtons" aria-expanded="false" aria-label="Toggle navigation">
        <span class="burger-line"></span>
        <span class="burger-line"></span>
        <span class="burger-line"></span>
        </button>

      
      <div class="collapse navbar-collapse justify-content-md-end" id="navbarButtons">
        <div class="d-flex flex-column flex-md-row gap-2 border-bottom pb-2">
          <a href="main.html" class="btn">Accueil</a>
          <a href="#" class="btn" id='btn_user_listpet'>Liste des animaux</a>
          <a href="register.html" class="btn">Nous contacter</a>
          <a href="login.html" class="btn">Déconnexion</a>
        </div>
      </div>

    </div>
  </nav>
</header>

<div class="container-fluid mt-5" id='containerProfil'>
  <div class="row">
    
    <div class="col-12 col-md-3 p-4 mb-3 ms-3 mt-3 d-flex flex-column align-items-center rounded" id='divProfil'>
      <h2 class='text-center'>Bienvenue, <?php echo htmlspecialchars($nom); ?> !</h2>
      <div id="picture"></div>
      <div class="d-flex justify-content-start mt-1">
          <button class="btn" id="btn_profil" type="button">Profil</button>
      </div>
    </div>

    
    <div class="col-12 col-md-8 p-3 mt-3 rounded">
      <h2 class='text-center'>Espace utilisateur</h2>
      <div id="dynamicContainer">

    <!-- ZONE : FORMULAIRE PROFIL -->
    <div id="zoneProfil" class="d-none">
        <h3 class='text-center'>Profil</h3>
        <form method='POST' id="profilForm" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="photo" class="btn" id='btn_photo'>Choisir votre photo :</label>
            <input class='d-none' type="file" id="photo" name="photo" accept="image/*">
          </div>
          <button type="submit" class="btn" id='btn_form_profil'>Enregistrer</button>
        </form>
        <div class='text-center' id='message_profil_form'></div>
    </div>

    <!-- ZONE : TABLEAU DES ANIMAUX -->
    <div id="zoneTableau" class="d-none">
        <h3 class='text-center mt-5'>Liste des animaux</h3>
        <div class="mb-3 text-center">
            <input type="text" id="search_pet" class="form-control w-50 mx-auto" placeholder="Rechercher un animal par nom...">
        </div>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered text-center" id="pets_table">
                <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Genre</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</div>


  
            

 <script src="script.js"></script>
</body>
</html>
