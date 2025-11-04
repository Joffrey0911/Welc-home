<?php

session_start();
include 'config.php';


header('Content-Type: application/json');





$message ='';

if($_SERVER["REQUEST_METHOD"] === "POST") {


$nom= trim(htmlspecialchars($_POST['pet_name']));
$type = trim(htmlspecialchars($_POST['type']));
$genre = trim($_POST['gender']);




try{
    $sql = 'INSERT INTO pets(nom, type, genre)VALUES (:nom, :type, :genre)';
    $stmt = $pdo->prepare($sql);

    $stmt ->bindParam(':nom', $nom);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':genre', $genre);

    $stmt->execute();

    echo json_encode(['success'=> true, 'message'=>'Animal ajouté avec succès !']);
}catch (PDOException $e){
         echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
    }
};

    
?>

 



