<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_projet";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['signup'])) {
            $NomUtilisateurs = $_POST['NomUtilisateurs'];
            $EmailAddress = $_POST['EmailAddress'];
            $passwordd = $_POST['passwordd'];

			$sql = "INSERT INTO utilisateur(NomUtilisateurs, EmailAddress, passwordd, role) VALUES (:NomUtilisateurs, :EmailAddress, :passwordd, :role)";
			$stmt = $conn->prepare($sql);
			$stmt->execute([
				'NomUtilisateurs' => $NomUtilisateurs,
				'EmailAddress' => $EmailAddress,
				'passwordd' => $passwordd,
				'role' => 'user'
			]);

            header("Location: inscriptionn.php");
            exit();
        } elseif (isset($_POST['login'])) {
            $NomUtilisateurs = $_POST['NomUtilisateurs'];
            $passwordd = $_POST['passwordd'];

            $sql = "SELECT * FROM utilisateur WHERE NomUtilisateurs = :NomUtilisateurs AND passwordd = :passwordd";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'NomUtilisateurs' => $NomUtilisateurs,
                'passwordd' => $passwordd
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['NomUtilisateurs'] = $user['NomUtilisateurs'];
                $_SESSION['passwordd'] = $user['passwordd'];

                if ($user['role'] === 'admin') {
                    header("Location: admin.php");
                } elseif(($user['role'] === 'user')) {
                    header("Location: Accueil.php");
                }
                exit();
            } 
        }
    }
} catch (PDOException $e) {
    echo "Erreur lors de l'accès à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>inscription</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <!-- Sign up part -->
        <div class="signup">
            <form method="post">
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="NomUtilisateurs" placeholder="User name">
                <input type="email" name="EmailAddress" placeholder="Email">
                <input type="password" name="passwordd" placeholder="Password">
                <button name="signup">Sign up</button>
            </form>
        </div>
        <!-- Login part -->
        <div class="login">
            <form method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="text" name="NomUtilisateurs" placeholder="User name">
                <input type="password" name="passwordd" placeholder="Password">
                <button name="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

