<?php
session_start();

// On vérifie si l'utilisateur est connecté
if(!isset($_SESSION['username'])){
    // Si l'utilisateur n'est pas connecté on le redirige vers la page de connexion
    header("Location: connexion.php");
    exit();
} 

$username = $_SESSION['username'];



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cas Concret</title>
</head>
<body>
<h1>Bienvenue sur votre page d'accueil <?php echo htmlspecialchars($username); ?> </h1>
<a href="deconnexion.php">Déconnexion</a>
</body>
</html>