<?php
$host = "servinfo-maria";
$dbname = "DBbindaivin";
$username = "bindaivin";
$password = "bindaivin";

// Créer une connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    
    // Préparer la requête d'insertion
    $sql = "INSERT INTO utilisateurs (prenom, nom) VALUES (:prenom, :nom)";
    $stmt = $pdo->prepare($sql);
    
    // Lier les paramètres et exécuter la requête
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    
    // Exécuter l'insertion
    if ($stmt->execute()) {
        echo "<h2>Inscription réussie !</h2>";
        echo "<p>Nom : " . $nom . "</p>";
        echo "<p>Prénom : " . $prenom . "</p>";
    } else {
        echo "<p>Une erreur est survenue lors de l'inscription.</p>";
    }
} else {
    // Si le formulaire n'est pas encore soumis
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
    
    <form action="" method="POST">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <br><br>
        
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br><br>
        
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
<?php
}
?>
