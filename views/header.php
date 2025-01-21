<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz PHP</title>
    <!-- Lien vers le fichier CSS -->
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <!-- En-tête -->
    <header class="header">
        <h1>Bienvenue sur le Quiz PHP</h1>
        <div class="nav-buttons">
            <?php
            // Vérification avant de démarrer la session
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Gestion de la navigation utilisateur
            if (!isset($_SESSION['user_id'])) {
                echo '<a href="connexion" class="nav-button">Se connecter</a>';
                echo '<a href="inscription" class="nav-button">Créer un compte</a>';
            } else {
                echo '<span class="welcome-text">Bienvenue, ' . htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']) . '!</span>';
                echo '<a href="deconnexion" class="nav-button">Se déconnecter</a>';
            }
            ?>
        </div>
    </header>
</body>
</html>
