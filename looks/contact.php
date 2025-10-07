

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact - Nile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logo">Nile</div>
        <nav>
            <a href="acceuil.php">Accueil</a>
            <a href="produits.php">Produits</a>
            <a href="contact.php">Contact</a>
            <a href="connexion.php">Connexion</a>
            <a href="register.php">Créer un compte</a>
        </nav>
    </header>

    <!-- Section Contact -->
    <main>
        <h1>Contactez-nous</h1>
        <div class="form-container">
            <form action="send_contact.php" method="post">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Nile - Tous droits réservés.</p>
    </footer>

</body>
</html>
