
<link rel="stylesheet" href="style4.css">
<?php
session_start();
include 'connectBD.php';

if (isset($_SESSION['NomUtilisateurs'])) {
    $NomUtilisateurs = $_SESSION['NomUtilisateurs'];

    $sql = "SELECT * FROM utilisateur WHERE NomUtilisateurs = :NomUtilisateurs";
    $var = $conn->prepare($sql);
    
    $var->execute([
        'NomUtilisateurs' => $NomUtilisateurs,
    ]);

    $row = $var->fetch(PDO::FETCH_ASSOC);

} else {
    echo "Veuillez vous connecter d'abord.";
}

?>
   
   
   <link rel="stylesheet" href="style1.css">

   <table>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Adresse e-mail</th>
            <th>Mot de passe</th>
            <th>Action</th>
        </tr>
        <tr>
            <td><?php echo $row['NomUtilisateurs']; ?></td>
            <td><?php echo $row['EmailAddress']; ?></td>
            <td><?php echo $row['passwordd']; ?></td>
            <td><a href="modifyuser.php?id=<?php echo $row['id']; ?>"><img src="modify.png" alt="" style="margin: 10px; height: 10px;"></a>
                <a href="Quitter.php?id=<?php echo $row['id']; ?>"><img src="Logout.png" alt="" style="margin: 10px; height: 10px;"></a>
            </td>
        </tr>
    </table>

