<?php

session_start();

if (isset($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}

if (!empty($_POST)) {
    //s'il n'est pas vide
    if (
        isset($_POST["email"], $_POST["password"]) &&
        !empty($_POST["email"]) && !empty($_POST["password"])
    ) {
        //on verifie si c'est u email est valide

        $email = $_POST["email"];

        $_SESSION["error"] = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //email invalide
            $_SESSION["error"][] = "Email incorrect";
        }


        if ($_SESSION["error"] === []) {

            //on se connecte a la base de donnee
            require_once "includes/connection.php";

            $sql = "SELECT * FROM `users` WHERE `email` = :email";

            $query = $db->prepare($sql);

            $query->bindValue(":email", $email, PDO::PARAM_STR);

            $query->execute();

            $user = $query->fetch();

            if (!$user) {
                $_SESSION["error"][] = "Mot de passe ou identifiant incorrect";
            }

            if (!password_verify($_POST["password"], $user["password"])) {
                $_SESSION["error"][] = "Mot de passe ou identifiant incorrect";
            }

            //Ici l'utilisateur et le mot de passe sont correct
            //On va pouvoir connecter l'utilisateur
            if ($_SESSION["error"] === []) {

                session_start();
                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "username" => $user["username"],
                    "email" => $user["email"],
                    "roles" => $user["roles"],
                ];

                //une fois le formulaire valider, la session ouvert, on redirige l'utilsateur
                header("Location: profil.php");
            }
        }
    } else {
        //formulaire incommplet
        $_SESSION["error"][] = "Formulaire incorrect";
    }
}

$titre = "Inscription";

include "includes/hearder.php";

include "includes/navbar.php";

?>


<div class="container">
    <h2>Inscription</h2>

    <?php

    if (isset($_SESSION["error"])) {
        foreach ($_SESSION["error"] as $message) {
    ?>
            <p><?= $message ?></p>
    <?php
        }
        unset($_SESSION["error"]);
    }
    ?>

    <form method="POST">
        <div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="pass">Mot de passe</label>
                <input type="password" name="password" id="pass">
            </div>
            <button type="submit">Me connecter</button>
        </div>
    </form>
</div>

<?php


include "includes/footer.php";

?>