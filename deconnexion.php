<?php 

//On supprimer la variable $_session

session_start();

unset($_SESSION["user"]);

header("Location: index.php");