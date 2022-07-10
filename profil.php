<?php
session_start();

$titre = "Mon profil";

include "includes/hearder.php";

include "includes/navbar.php";

?>

<div class="container">
<h2>Profil de <?= $_SESSION["user"]["username"] ?></h2><br>

<h3>Pseudo: <?= $_SESSION["user"]["username"] ?></h3>
<h3>Email: <?= $_SESSION["user"]["email"] ?></h3>
</div>

<?php

include "includes/footer.php";

?>