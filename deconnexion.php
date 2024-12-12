<?php
// Démarre la session 
session_start();

// Supprime toute les données (variable) de la session 
session_unset();

// Détruit la session 
session_destroy();

header("Location: connexion.php");
exit();