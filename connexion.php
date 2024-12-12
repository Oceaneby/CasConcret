<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Étape 1 : Récupération de la donnée utilisateur
    require 'config.php';

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
</head>
<body>
<form method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <input type="submit" value="Connexion">
</form>
</body>
</html>