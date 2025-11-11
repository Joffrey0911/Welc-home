<?php

session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header('Location: login.html');
    exit;
}
?>
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
    <body id='admin_page'>
        <header class="container-fluid">
            <h1 class='d-flex justify-content-center'>Welc'home</h1>
            <div class="pictureBear">
                <img src="assets/ai-generated-8577262_640.png" alt="image d'ours">
                <nav>
                    <ul class='container list-unstyled d-flex justify-content-end align-items-center py-3 d-grid gap-3'>
                        <li>
                            <a href='login.php' class="btn btn-outline-primary" id='btn_list_pet'>Liste des animaux</a>
                        </li>
                        <li>
                            <a href='#' class="btn btn-outline-primary" id='btn_add_pet'>Ajouter animaux</a>
                        </li>
                        <li>
                            <a href='main.html' class="btn btn-outline-primary">Accueil</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

            
    <main>
        <section>
            <div class='row justify-content-start'>
                <div class='col-12 col-sm-8 col-md-6 col-lg-4'>
                    <h2 class='text-center mt-2'>Espace administrateur</h2>
                    <div class="col-6-lg col-12-sm mt-5 ms-5" id="cam">
                            <img src="assets/pexels-pixabay-62289.jpg" alt ='image cameleon'>
                    </div>
                </div>
                <div class='col-12 col-md-6 d-flex justify-content-center align-items-center' id='container_wrap'>
                    <div class="position-relative w-75">
                        <div class="w-100 border border-primary rounded-3 p-3 mt-5 d-none" id='form_pet_container'>
                            <h3 class='text-center'>Ajoutez un animal</h3>
                            <form class='d-grid gap-2' id='form_pet' method='POST'>
                                <input class="form-control border border-primary rounded" name="pet_name" id='pet_name' type="text" placeholder="Entrez le nom de l'animal">
                                <input class="form-control border border-primary rounded" name="type" id='type' type="text" placeholder="Entrez le type de l'animal">
                                <p class='text-center mt-2' style='color: blueviolet'>Genre de l'animal</p>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Mâle" checked>
                                    <label class="form-check-label" for="male">Mâle</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Femelle">
                                    <label class="form-check-label" for="female">Femelle</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="unknown" value="Inconnu">
                                    <label class="form-check-label" for="unknown">Inconnu</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </form>
                            <div id='message' class='text-center mt-3'></div>
                        </div>
                    <div class='w-100 d-none' id='list_pet_container'>
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
                                    <tbody>
                                    <!-- Les lignes seront ajoutées par JS -->
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    </div>
                </div>
            </section>
        </main>
        <script src="script.js"></script>
    </body>
</html>
                   
                    
                
            
            

