<?php
    require 'header.php';
    require 'bdd.php';

    $bdd = connexionBdd();
    $oeuvres = $bdd->query('SELECT * FROM artworks ORDER BY artwork_id ASC');
?>

<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['artwork_id'] ?>">
                <img src="<?= $oeuvre['imageUrl'] ?>" alt="<?= $oeuvre['title'] ?>">
                <h2><?= $oeuvre['title'] ?></h2>
                <p class="description"><?= $oeuvre['artist'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
