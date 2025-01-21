<?php
use Forms\LoginForm;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define('DB_PATH', __DIR__ . '/../data/database.sqlite');

function initializeDatabase(): \PDO {
    $pdo = new \PDO('sqlite:' . DB_PATH);

    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = initializeDatabase();

    $identifiant = trim($_POST['identifiant'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($identifiant && $password) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE identifiant = :identifiant LIMIT 1");
            $stmt->execute([':identifiant' => $identifiant]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'identifiant' => $user['identifiant'],
                    'prenom' => $user['prenom'],
                    'nom' => $user['nom']
                ];
            
                $_SESSION['message'] = "Connexion réussie !";
                header("Location: /questions");
                exit;
            } else {
                $message = "Erreur : Identifiant ou mot de passe incorrect.";
            }
        } catch (\PDOException $e) {
            $message = "Erreur : " . $e->getMessage();
        }
    } else {
        $message = "Erreur : Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="assets/css/connexion.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Connexion</h1>
    <?php if (!empty($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <?php
    $connexion = new LoginForm('/connexion');
    echo $connexion->render();
    ?>
    <?php include 'footer.php'; ?>
</body>
</html>