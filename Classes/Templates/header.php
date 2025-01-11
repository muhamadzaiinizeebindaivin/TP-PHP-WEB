<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz PHP</title>
    <link rel="stylesheet" href="../_inc/static/style.css">
</head>
<body>

<div class="header">
    <div class="nav-buttons">
        <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
            echo '<a href="connexion.php" class="nav-button">Se connecter</a>';
            echo '<a href="inscription.php" class="nav-button">Créer un compte</a>';
        } else {
            echo '<span class="welcome-text">Bienvenue ' . htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']) . '</span>';
            echo '<a href="deconnexion.php" class="nav-button">Se déconnecter</a>';
        }
        ?>
    </div>
    <h1>Quiz PHP</h1>
</div>