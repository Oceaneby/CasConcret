<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Étape 1 : Récupération de la donnée utilisateur
    require_once 'config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);;


       // Étape 2 : Préparation de la requête
    // ICI on vérifie si le nom d'utilisateur soit unique dans la base de données
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);

    // Étape 3 : Exécution avec liaison
    $stmt->execute([':username' => $username]);

    // Étape 4 : Traitement du résultat
    // On récupère l'utilisateur si trouver
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Donc si l'utilisateur existe, je veux vérifier le mot de passe

    if($user && password_verify($password, $user['password'])){
            // Le mot de passe est valide : création d'une session
            // On récupère pour le stocker le nom d'utilisateur dans des variable session.
            $_SESSION['username'] = $username;

            // Redirection vers la page d'accueil en cas de succès
            header("Location: accueil.php");
            exit();
    } else{
        echo "Nom d'utilisateur ou mot de passe incorrect";
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
    <h1>Accédez à votre compte !</h1>
<form method="POST">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <input class="btn" type="submit" value="Connexion">
</form>
</body>
</html>