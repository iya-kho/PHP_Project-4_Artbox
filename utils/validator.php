<?php

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

function validator($data) {
  $errors = [];
  $isValid = true;

  if (isEmpty($data)) {
    $errors[] = 'Veuillez remplir tous les champs';
    $isValid = false;
  } 
  if (!filter_var($data['image'], FILTER_VALIDATE_URL)) {
    $errors[] = 'L\'URL de l\'image n\'est pas valide';
    $isValid = false;
  }
  if (strlen($data['description']) < 3) {
    $errors[] = 'La description doit faire au moins 3 caractères';
    $isValid = false;
  }

  return ['isValid' => $isValid, 'errors' => $errors];
}