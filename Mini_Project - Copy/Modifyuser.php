<link rel="stylesheet" href="style4.css">
<?php
$dsn = 'mysql:host=localhost;dbname=mini_projet';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM utilisateur WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $exercice = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $NomUtilisateurs = $_POST['NomUtilisateurs'];
        $EmailAddress = $_POST['EmailAddress'];
        $passwordd = $_POST['passwordd'];

        $sql = "UPDATE utilisateur SET NomUtilisateurs = :NomUtilisateurs, EmailAddress = :EmailAddress, passwordd = :passwordd WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'NomUtilisateurs' => $NomUtilisateurs,
            'EmailAddress' => $EmailAddress,
            'passwordd' => $passwordd,
        ]);

        header("Location: Accueil.php?message=La modification a été effectuée avec succès");
        exit();
    }
} catch(PDOException $e) {
    echo "Erreur lors de l'accès à la base de données : " . $e->getMessage();
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $exercice['id']; ?>">
    
    <label for="titre">NomUtilisateurs :</label>
    <input type="text" name="NomUtilisateurs" id="NomUtilisateurs" value="<?php echo $exercice['NomUtilisateurs']; ?>" required><br>
    
    <label for="auteur">EmailAddress :</label>
    <input type="text" name="EmailAddress" id="EmailAddress" value="<?php echo $exercice['EmailAddress']; ?>" required><br>
    
    <label for="passwordd">password :</label>
    <input type="text" name="passwordd" id="passwordd" value="<?php echo $exercice['passwordd']; ?>" required><br>

    <input type="submit" value="Modifier">
</form>