<?php

if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
    //on a un image
    //on verifie l'extension et le type mime
    $permis = [
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpg",
        "png" => "image/png"
    ];

    $nomFichier = $_FILES["image"]["name"];
    $mimeType = $_FILES["image"]["type"];
    $tailleFichier = $_FILES["image"]["size"];

    $extension = pathinfo($nomFichier, PATHINFO_EXTENSION);

    if(!array_key_exists($extension, $permis) || !in_array($mimeType, $permis))
    {
        //Ici sois l'extention est incoorect soit le type est incorrect
        die("Erreur: Format de fichier incorrect");
    }

    //ici le type est correct
    //on limite donc sa taille a 1M
    if($tailleFichier > 1024 * 1024)
    {
        die("FIchier trop volumineux");
    }

    $nouveauNom = uniqid();

    $nouveauNomFichier = __DIR__ . "/uploads/$nouveauNom.$extension";
    var_dump($_FILES);

    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $nouveauNomFichier))
    {
        die("echec d'upload");
    }
    chmod($nouveauNomFichier, 0644);


    // var_dump($nouveauChemin);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h2>Ajout de fichiers</h2>
        <br>
        <div class="card">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                <label for="fichier">Fichier</label>
                </div>
                <div>    
                    <input type="file" name="image" id="fichier">
                </div><br>
                <button type="submit">Envoyez</button>
            </form>
        </div>
    </div>
</body>

</html>