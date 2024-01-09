<?php

require 'header.php';

$formData = $_POST;

// Vérifier que le formulaire a été soumis

if (!isset($formData['submit'])) {
  header('Location: index.php');
  exit();
}

// Vérifier que tous les champs sont remplis

function isEmpty($data) {
  foreach ($data as $key => $value) {
    if (empty($value) || trim($value) == '') {
      return true;
    }
  }
  return false;
}

//Vérifier que la forme est valide

if (isEmpty($formData)) {
  echo 'Veuillez remplir tous les champs';
  return;
} elseif (!filter_var($formData['image'], FILTER_VALIDATE_URL)) {
  echo 'L\'URL de l\'image n\'est pas valide';
  return;
} elseif (strlen($formData['description']) < 3) {
  echo 'La description doit faire au moins 3 caractères';
  return;
}

$titre = htmlspecialchars($formData['titre']);
$artiste = htmlspecialchars($formData['artiste']);
$image = htmlspecialchars($formData['image']);
$description = htmlspecialchars($formData['description']);

// Ajouter l'oeuvre à la base de données

require 'bdd.php';

$bdd = connexionBdd();
$sqlQuery = 'INSERT INTO artworks (title, artist, description, imageUrl) VALUES (:titre, :artiste, :description, :image)';
$req = $bdd->prepare($sqlQuery);
$req->execute([
  'titre' => $titre,
  'artiste' => $artiste,
  'description' => $description,
  'image' => $image
]);

header('Location: oeuvre.php?id=' . $bdd->lastInsertId());

require 'footer.php';

?>