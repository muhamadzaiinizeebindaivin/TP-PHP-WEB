<?php
// Include the necessary classes
use Forms\SignUpForm;

// Database configuration
define('DB_PATH', __DIR__ . '/../data/database.sqlite');

// Function to initialize the database and table
function initializeDatabase(): \PDO {
    if (!file_exists(dirname(DB_PATH))) {
        mkdir(dirname(DB_PATH), 0777, true);
    }

    // Create or open the database
    $pdo = new \PDO('sqlite:' . DB_PATH);

    // Set error mode for PDO
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    // Create the users table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            identifiant TEXT NOT NULL UNIQUE,
            prenom TEXT NOT NULL,
            nom TEXT NOT NULL,
            password TEXT NOT NULL
        );
    ");

    return $pdo;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = initializeDatabase();

    // Sanitize and validate user input
    $identifiant = trim($_POST['identifiant'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');

    if ($identifiant && $prenom && $nom && $password && $password === $confirmPassword) {
        try {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data into the database
            $stmt = $pdo->prepare("
                INSERT INTO users (identifiant, prenom, nom, password)
                VALUES (:identifiant, :prenom, :nom, :password)
            ");
            $stmt->execute([
                ':identifiant' => $identifiant,
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':password' => $hashedPassword
            ]);

            $message = "Inscription réussie !";
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000') {
                $message = "Erreur : L'identifiant est déjà utilisé.";
            } else {
                $message = "Erreur : " . $e->getMessage();
            }
        }
    } else {
        $message = "Erreur : Veuillez remplir tous les champs correctement.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription</title>
    <link rel="stylesheet" href="assets/css/inscription.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Inscription</h1>
    <?php if (!empty($message)): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <?php
    $inscription = new SignUpForm('/inscription');
    echo $inscription->render();
    ?>
    <?php include 'footer.php'; ?>
</body>
</html>
