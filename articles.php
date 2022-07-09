<?php

//on va chercher les articles dans la base
require_once "includes/connection.php";

$sql = "SELECT * FROM `articles` ORDER BY `created_at` DESC";

$requete = $db->query($sql);

$articles = $requete->fetchAll();

// echo "<pre>";

// var_dump($articles);

// echo "</pre>";

$titre = "Liset des articles";

@include "includes/hearder.php";

include "includes/navbar.php";

?>

<section>
    <div class="card">
    <h2 class="text-center">Liste des articles</h2><br><br>
       <div class="container">
       <?php foreach ($articles as $article) : ?>
            <div class="card">
                <article>
                    <h3><?= $article["title"] ?></h3>
                    <p><?= $article["created_at"] ?></p>
                    <div><?= $article["content"] ?></div>
                </article><br>
            </div><br>
        <?php endforeach; ?>
    </div>
       </div>
</section>
<?php
include "includes/footer.php";
?>