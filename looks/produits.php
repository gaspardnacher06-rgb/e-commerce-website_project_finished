<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupérer les produits
$sql = "SELECT * FROM produits";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits - Nile</title>
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

    <!-- Section Produits -->
    <main>
        <h1>Nos Produits</h1>
        <div class="produits-container">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='produit'>";
                    echo "<img src='" . $row["image"] . "' alt='" . $row["nom"] . "'>";
                    echo "<h2>" . $row["nom"] . "</h2>";
                    echo "<p>" . $row["description"] . "</p>";
                    echo "<p><strong>" . $row["prix"] . " €</strong></p>";
                    echo "<button>Ajouter au panier</button>";
                    echo "</div>";
                    echo "<a href='panier.php?add=" . $row["id"] . "'><button>Ajouter au panier</button></a>";

                }
            } else {
                echo "<p style='text-align:center;'>Aucun produit trouvé.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Nile - Tous droits réservés.</p>
    </footer>

</body>
</html>

<?php $conn->close(); ?>


</body>
</html>

<?php
$conn->close();
?>
