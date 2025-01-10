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
    
    // Requête pour vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT * FROM utilisateurs WHERE prenom = :prenom AND nom = :nom";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    
    // Vérification si l'utilisateur existe
    if ($stmt->rowCount() > 0) {
        echo "<h2>Bienvenue, " . $prenom . " " . $nom . " !</h2>";
    } else {
        echo "<p>Nom ou prénom incorrect.</p>";
    }
} else {
    // Si le formulaire n'est pas encore soumis
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    
    <form action="" method="POST">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>
        <br><br>
        
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br><br>
        
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
<?php
}
?>
