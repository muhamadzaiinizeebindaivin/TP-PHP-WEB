<?php
use Forms\LoginForm;

// Start the session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Database configuration
define('DB_PATH', __DIR__ . '/../data/database.sqlite');

// Function to initialize the database and table
function initializeDatabase(): \PDO {
    // Create or open the database
    $pdo = new \PDO('sqlite:' . DB_PATH);

    // Set error mode for PDO
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = initializeDatabase();

    // Sanitize and validate user input
    $identifiant = trim($_POST['identifiant'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($identifiant && $password) {
        try {
            // Prepare query to get the user from the database
            $stmt = $pdo->prepare("SELECT * FROM users WHERE identifiant = :identifiant LIMIT 1");
            $stmt->execute([':identifiant' => $identifiant]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            // Check if user exists and verify the password
            if ($user && password_verify($password, $user['password'])) {
                // Successful login: Start the session and store user data
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'identifiant' => $user['identifiant'],
                    'prenom' => $user['prenom'],
                    'nom' => $user['nom']
                ];
            
                // Set a success message and redirect to the /questions page
                $_SESSION['message'] = "Connexion réussie !";
                header("Location: /questions"); // Redirect to the questions page
                exit;
            } else {
                // Incorrect password or username
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