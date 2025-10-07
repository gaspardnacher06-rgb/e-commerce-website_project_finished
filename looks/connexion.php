<?php
session_start();

// Connexion BDD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$message = "";

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Chercher l'utilisateur
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Vérifier le mot de passe haché
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: acceuil.php");
            exit;
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $message = "Utilisateur non trouvé.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Nile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">Nile</div>
    <nav>
        <a href="acceuil.php">Accueil</a>
        <a href="produits.php">Produits</a>
        <a href="contact.php">Contact</a>
        <a href="register.php">Créer un compte</a>
    </nav>
</header>

<main>
    <h1>Connexion</h1>
    <div class="form-container">
        <?php if ($message): ?>
            <p style="color:red;"><?= $message ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</main>

<footer>
    <p>&copy; 2025 Nile - Tous droits réservés.</p>
</footer>
</body>
</html>
