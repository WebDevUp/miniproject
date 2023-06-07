<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_projet";
try{
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$var = $conn->prepare("SELECT * FROM utilisateur");
$var->execute();



$rows = $var->fetchALL(PDO::FETCH_ASSOC);
}

catch(PDOException $e){

    echo "Errrer:" . $e->getMessage();
}
?>
    <link rel="stylesheet" href="style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style4.css">
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>EmailAddress</th>
        <th>Password</th>
        <th>role</th>
        <th>Action</th>
        <th><a href="Add a"></a></th>
    </tr> 
    <?php 
    foreach ($rows as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['NomUtilisateurs']; ?></td>
            <td><?php echo $row['EmailAddress']; ?></td>
            <td><?php echo $row['passwordd']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="modify.php?id=<?php echo $row['id']; ?>"><img src="modify.png" alt="" style="margin: 10px; height: 10px;"></a>
                <a href="delete.php?id=<?php echo $row['id']; ?>"><img src="delete.png" alt="" style="margin: 10px; height: 10px;"></a>
            </td>

         </tr> 
        <?php endforeach; ?>
        

</table>