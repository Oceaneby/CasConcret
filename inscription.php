<?php

session_start(); // Obligatoire pour accéder aux données de session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Étape 1 : Récupération de la donnée utilisateur
    require_once 'config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

   

    // Étape 2 : Préparation de la requête
    // ICI on vérifie si le nom d'utilisateur soit unique dans la base de données
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    // Étape 3 : Exécution avec liaison
    $stmt->execute([':username' => $username]);

    // Étape 4 : Traitement du résultat
    // On récupère l'utilisateur si trouver
    $user = $stmt->fetch(PDO::FETCH_ASSOC);




    // Si utilisateur existe déjà, afficher un message d'erreur
    if ($user) {
     echo "L'utilisateur existe déjà. Veuillez choisir un autre nom d'utilisateur";
    } else {
        // Hachage du mots de passe pour sécurité
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);;

        // Puis on insert l'utilisateur dans la base de données
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashed_password
        ]);
        echo "Inscription réussie ! ";

        // Redirection vers la page de connexion après inscription réussie
        header("Location: connexion.php");
        exit(); 
        // Important : arrêter l'exécution du script après la redirection
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cas Concret</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Rejoignez-nous dès aujourd'hui !</h1>
<form method="POST">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <input class="btn"  type="submit" value="S'inscrire">
</form>
</body>
</html>


