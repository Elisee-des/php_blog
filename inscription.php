<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}

if (!empty($_POST)) {
    //s'il n'est pas vide
    if (
        isset($_POST["nickname"], $_POST["email"], $_POST["password"]) &&
        !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["password"])
    ) {
        $pseudo = strip_tags($_POST["nickname"]);

        $email = $_POST["email"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("l'adress est incorrect");
        }
        //Ici on ajoute nos differente controlle

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        include_once "includes/connection.php";

        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `roles`)
            VALUES (:pseudo, :email, '$password', '[\"ROLE_USER\"]')";

        $query = $db->prepare($sql);

        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->bindValue(":email", $email, PDO::PARAM_STR);

        //on recupere le id l'utilisateur
        $id = $db->lastInsertId();
        $query->execute();

        //on connectera l'utilsateur
        //on demarre la session en php

        
        //on stocke le information de l'utilisateur dans $_SESSION
        $_SESSION["user"] = [
            "id" => $id,
            "username" => $pseudo,
            "email" => $email,
            "roles" => $user["ROLE_USER"],
        ];

        header("Location: profil.php");

    } else {
        die("Remplissez tout les champs");
    }
}

$titre = "Inscription";

include "includes/hearder.php";

include "includes/navbar.php";

?>


<div class="container">
    <h2>Inscription</h2>
    <form method="POST">
        <div>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="nickname" id="pseudo">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="pass">Mot de passe</label>
                <input type="password" name="password" id="pass">
            </div>
            <button type="submit">Je m'inscris</button>
        </div>
    </form>
</div>

<?php


include "includes/footer.php";

?>