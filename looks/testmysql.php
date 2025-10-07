<?php
$host = "127.0.0.1";
$user = "root";
$password = "";  // ajoute ton mot de passe si tu en as mis un
$dbname = "ecommerce"; // mets ici le nom de ta base

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie !"; // tu peux tester puis commenter
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
