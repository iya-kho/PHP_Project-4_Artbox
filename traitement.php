<?php
require_once 'repositories/dbManager.php';
require_once 'utils/validator.php';


// Vérifier que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $formData = $_POST;

  // Vérifier que les données sont valides
  $validation = validator($formData);

  // Si les données sont valides, ajouter l'oeuvre à la base de données
  if ($validation['isValid']) {
    $titre = htmlspecialchars($formData['titre']);
    $artiste = htmlspecialchars($formData['artiste']);
    $image = htmlspecialchars($formData['image']);
    $description = htmlspecialchars($formData['description']);

    $newId = addWork([
      'titre' => $titre, 
      'artiste' => $artiste, 
      'image' => $image, 
      'description' => $description
    ]); 

    header('Location: oeuvre.php?id=' . $newId);
  }

  foreach ($validation['errors'] as $error) {
    echo '<p class="errorMessage">' . $error . '</p>';
  }
}
