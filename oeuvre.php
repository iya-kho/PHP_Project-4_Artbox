<?php
require_once 'views/header.php';
require_once 'models/dbManager.php';

// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
if(empty($_GET['id'])) {
    header('Location: index.php');
    exit();
}

// On récupère l'oeuvre correspondant à l'id
$oeuvre = getOneWork($_GET['id']);

// Si aucune oeuvre trouvée, on redirige vers la page d'accueil
if(!$oeuvre) {
    header('Location: index.php');
    exit();
}

require_once 'views/oeuvreInfo.php';

require_once 'views/footer.php';
