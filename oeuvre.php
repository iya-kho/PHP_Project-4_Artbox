<?php
    require 'header.php';
    require 'bdd.php';

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
        exit();
    }

    $bdd = connexionBdd();
    $sqlQuery = 'SELECT * FROM artworks WHERE artwork_id = :id';
    $req = $bdd->prepare($sqlQuery);
    $req->execute(['id' => intval($_GET['id'])]);
    $oeuvre = $req->fetch();

    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if(!$oeuvre) {
        header('Location: index.php');
        exit();
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['imageUrl'] ?>" alt="<?= $oeuvre['title'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['title'] ?></h1>
        <p class="description"><?= $oeuvre['artist'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
