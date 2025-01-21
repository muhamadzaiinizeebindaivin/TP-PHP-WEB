<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz PHP</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>

<div class="header">
    <div class="nav-buttons">
        <?php
        // Start the session if it hasn't been started already
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is logged in
        if (!isset($_SESSION['user'])) {
            // Show login and registration buttons if the user is not logged in
            echo '<a href="connexion" class="nav-button">Se connecter</a>';
            echo '<a href="inscription" class="nav-button">Créer un compte</a>';
        } else {
            // Show user greeting and logout button if the user is logged in
            echo '<span class="welcome-text">Bienvenue, ' . htmlspecialchars($_SESSION['user']['prenom']) . ' ' . htmlspecialchars($_SESSION['user']['nom']) . '!</span>';
            echo '<a href="deconnexion" class="nav-button">Se déconnecter</a>';
        }
        ?>
    </div>
</div>