<?php 

//On supprimer la variable $_session

session_start();
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}

unset($_SESSION["user"]);

header("Location: index.php");