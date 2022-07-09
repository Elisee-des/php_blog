<?php
//on verifie si on a un id
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    //La on na pas de id
    header("Location: articles.php");
    exit;
}

//La on a un id
$id = $_GET["id"];

//on va chercher l'articles dans la base
require_once "includes/connection.php";

$sql = "SELECT * FROM `articles` WHERE id=$id";

//on prepare notre requette
$requete = $db->prepare($sql);

//On securise notre requette
$user = $requete->bindValue(":id", $id, PDO::PARAM_INT);

//on execute notre requette
$requete->execute();

//on recupere notre articles
$article = $requete->fetch();

//on verifie si on a un articles
if (empty($article)) {
    //on na pas d'articles
    http_response_code(404);
    echo "Cette article n'existe pas";
    exit;
}

//La on a un article

$titre = strip_tags($article["title"]);

@include "includes/hearder.php";

include "includes/navbar.php";

?>

<div class="card">
    <br><br>
    <div class="container">
        <div class="card">
            <article>
                <h3><?= strip_tags($article["title"]) ?></h3>
                <p><?= $article["created_at"] ?></p>
                <div><?= strip_tags($article["content"]) ?></div>
            </article><br>
        </div><br>
    </div>
</div>
<?php
include "includes/footer.php";
?>