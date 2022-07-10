<br>
<h1 class="text-center">Mon petit Blog</h1>
<nav class="nav justify-content-center">
    <ul class="text-align">
        <li><a href="index.php">Accueil </a></li>
        <li><a href="">Contact</a></li>
        <li><a href="articles.php">Articles</a></li>
        <?php if (isset($_SESSION["user"])) : ?>
            <li><a href="deconnexion.php">Deconnexion</a></li>
            <?php else : ?>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
        <?php endif ?>
    </ul>
</nav>
</header>