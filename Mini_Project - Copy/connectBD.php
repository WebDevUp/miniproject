<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_projet";

try{
$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);

$conn->setattribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);



}


 catch(PDOException $e) {
    echo "Erreur lors de l'accès à la base de données : " . $e->getMessage();
}

?>

<link rel="stylesheet" href="style4.css">