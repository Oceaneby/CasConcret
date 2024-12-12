 <?php


// var_dump(extension_loaded('pdo'));

// $dsn = 'mysql:host=localhost;dbname=exercice_auth;charset=utf8';
// $user = 'root';
// $pass = '';

// try{
//     $pdo = new PDO($dsn, $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     echo "connexion réussie !";
// } catch (PDOException $e){
//     echo "Erreur de connexion : " .$e->getMessage();
// } -->






$dsn = 'mysql:host=localhost;dbname=exercice_auth;charset=utf8';
$user = 'root';
$pass = '';

try {
    // Création de l'instance PDO
    $pdo = new PDO($dsn, $user, $pass);

    // Configuration pour lever des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie !";
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    echo "Erreur de connexion : " . $e->getMessage();
}