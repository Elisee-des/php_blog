<?php

    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASSWORD', '');
    define('DBNAME', 'php_blog');

    //DSN de connexion
    $dns = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

    //on se connecte
    try {
        //on instansi pdo
        $db = new PDO($dns, DBUSER, DBPASSWORD);

        //on envoie les donner en utf8
        $db->exec("SET NAMES utf8");

        //on definis le mode de fetch par defaut
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur:" . $e->getMessage());
    }

    //ici on nai connecter
    $sql = "SELECT * FROM `users` WHERE id=1";

    $requete = $db->query($sql);

    //Affichage les data de la base de donner
    // $user = $requete->fetch();

    //Ajoute des data a la de donnee
    $sql = "INSERT INTO `users`(`email`, `password`, `roles`) VALUES 
        ('user2@gmail.com', 'user2', '[\"ROLE_USER\"]')";

    // $requete = $db->query($sql);

    // $id = $db->lastInsertId();

    // die("ajouter avec success a la ligne $id");

    //Modification de donnees
    $sql = "UPDATE `users` SET `email`='user3@gmail.com' WHERE id=5";

    // $requete = $db->query($sql);

    //SUPPRESSION des donnees
    $sql = "DELETE FROM `users` WHERE id=4";

    // $requete = $db->query($sql);

    // echo $requete->rowCount();

    // echo "<pre>";

    // var_dump($user);

    // echo "</pre>";
