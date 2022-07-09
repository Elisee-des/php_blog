<?php

$titre = "Accueil";

include "includes/hearder.php";

include "includes/navbar.php";

?>

<p>Contenu de la page d'accueil</p>

<?php

require_once "includes/connection.php";

$username= "user0";
$password= "user0";

$sql = "SELECT *FROM `users` WHERE `username`=:username AND `password`=:password";


//on prepare la requete
$requete = $db->prepare($sql);

//on inject les valeur binValue

$requete->bindParam(":username", $username, PDO::PARAM_STR);
$requete->bindValue(":password", $password, PDO::PARAM_STR);

//on execute
$requete->execute();

$user = $requete->fetchAll();

echo "<pre>";

var_dump($user);

echo "</pre>";

include "includes/footer.php";

?>