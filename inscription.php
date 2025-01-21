<?php
$database = __DIR__ . "/database.sqlite";

try {
    $pdo = new PDO("sqlite:" . $database);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE TABLE IF NOT EXISTS  utilisateurs (
        prenom TEXT NOT NULL,
        nom TEXT NOT NULL,
        PRIMARY KEY (prenom, nom)
    )");
    
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

$message = ""; // Variable to hold messages

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = trim(htmlspecialchars($_POST['prenom']));
    $nom = trim(htmlspecialchars($_POST['nom']));

    // Insert new user if they don't already exist
    $sqlInsert = "INSERT INTO utilisateurs (prenom, nom) VALUES (:prenom, :nom)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->bindParam(':prenom', $prenom);
    $stmtInsert->bindParam(':nom', $nom);
    
    try {
        $stmtInsert->execute();
        $message = "<p style='color: green;'>Inscription réussie !</p>";
    } catch (PDOException $e) {
        $message = "<p style='color: red;'>L'utilisateur existe déjà.</p>";
    }

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'inscription</title>
</head>
<body>
    <h1>Inscription d'un utilisateur</h1>

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
        
        <button type="submit">S'inscrire</button>
    </form>
    <a href="connexion.php">Se connecter</a>
    <a href="/">Retour au quiz</a>
</body>
</html>
