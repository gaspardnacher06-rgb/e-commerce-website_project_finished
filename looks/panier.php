<?php
session_start();

// Initialiser le panier s’il n’existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un produit au panier (si reçu depuis produits.php)
if (isset($_GET['add'])) {
    $id = intval($_GET['add']); // id produit
    if (!in_array($id, $_SESSION['panier'])) {
        $_SESSION['panier'][] = $id;
    }
}

// Supprimer un produit du panier
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    $_SESSION['panier'] = array_diff($_SESSION['panier'], [$id]);
}

// Vider le panier
if (isset($_GET['clear'])) {
    $_SESSION['panier'] = [];
}

// Connexion à la BDD pour récupérer les infos produits
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$produits = [];
if (!empty($_SESSION['panier'])) {
    $ids = implode(",", $_SESSION['panier']);
    $sql = "SELECT * FROM produits WHERE id IN ($ids)";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $produits[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier - Nile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">Nile</div>
    <nav>
        <a href="acceuil.php">Accueil</a>
        <a href="produits.php">Produits</a>
        <a href="contact.php">Contact</a>
        <a href="panier.php">Panier</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="connexion.php">Connexion</a>
            <a href="register.php">Créer un compte</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <h1>Votre panier</h1>

    <?php if (empty($produits)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <div class="produits-container">
            <?php foreach ($produits as $produit): ?>
                <div class="produit">
                    <img src="<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>">
                    <h2><?= $produit['nom'] ?></h2>
                    <p><?= $produit['description'] ?></p>
                    <p><strong><?= $produit['prix'] ?> €</strong></p>
                    <a href="panier.php?remove=<?= $produit['id'] ?>">
                        <button>Supprimer</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <br>
        <a href="panier.php?clear=1"><button>Vider le panier</button></a>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; 2025 Nile - Tous droits réservés.</p>
</footer>

</body>
</html>
