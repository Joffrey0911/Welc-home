<?php

include'add_pet.php'
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
    <body>
        <header class="container-fluid">
            <h1 class='d-flex justify-content-center'>Welc'home</h1>
            <div class="pictureBear">
                <img src="assets/ai-generated-8577262_640.png" alt="image d'ours">
                <nav class='container d-flex justify-content-end align-items-center py-3 d-grid gap-2'>
                    <a href='login.php' class="btn btn-outline-primary">Liste des animaux</a>
                    <a href='#' class="btn btn-outline-primary" id='btn_add_pet'>Ajouter animaux</a>
                    <a href='main.php' class="btn btn-outline-primary">Accueil</a>
                </nav>
            </div>
        </header>

            <h2 class='text-center mt-2'>Espace administrateur</h2>
    <main>
        <section>
            <div class='row justify-content-start'>
                <div class='col-12 col-sm-8 col-md-6 col-lg-4'>
                    <div class="col-6-lg col-12-sm mt-5 ms-5" id="cam">
                            <img src="assets/pexels-pixabay-62289.jpg" alt ='image cameleon'>
                    </div>
                </div>
                <div class='col-12 col-sm-8 col-md-6 col-lg-4 mt-5 border border-3 border border-primary rounded-3 p-3 d-none' id='form_pet'>
                    <h3 class='text-center'>Ajoutez un animal</h3>
                    <form class='d-grid gap-2'  method='POST'>
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
                </div>
                <div class='text-center mt-2' style='color: red' id='error_message'></div>
                <div class='text-center mt-2' style='color: green'></div>
                <?php if(!empty($message)) echo $message; ?>

            </div>
        </section>
    </main>
        <script src="script.js"></script>
    </body>
</html>
               
