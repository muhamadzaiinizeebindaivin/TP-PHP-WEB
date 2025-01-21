<?php
$database = __DIR__ . "/database.sqlite";

try {
    $pdo = new PDO("sqlite:" . $database);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

$message = ""; // Variable to hold messages

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = trim(htmlspecialchars($_POST['prenom']));
    $nom = trim(htmlspecialchars($_POST['nom']));

    // Debugging: Check what values are being received from the form
    var_dump($prenom, $nom);  // REMOVE this line in production, it prints the values

    // Check if the user exists
    $sqlCheck = "SELECT * FROM utilisateurs WHERE prenom = :prenom AND nom = :nom";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindParam(':prenom', $prenom);
    $stmtCheck->bindParam(':nom', $nom);

    try {
        $stmtCheck->execute();
        
        // Debugging: Check how many rows were returned
        //var_dump($stmtCheck->fetch());  // REMOVE this line in production, it shows the row count

        if (count($stmtCheck->fetch()) > 0) {
            // User found, login success
            $message = "<p style='color: green;'>Connexion réussie !</p>";
        } else {
            // User not found
            $message = "<p style='color: red;'>Utilisateur non trouvé.</p>";
        }
    } catch (PDOException $e) {
        $message = "<p style='color: red;'>Une erreur est survenue lors de la connexion.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php
    // Display the message if it exists
    if (!empty($message)) {
        echo $message;
    }
    ?>
    
    <form action="" method="POST">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <br><br>
        
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br><br>
        
        <button type="submit">Se connecter</button>
    </form>
    <a href="inscription.php">S'inscrire</a>
    <a href="/">Retour au quiz</a>
</body>
</html>
