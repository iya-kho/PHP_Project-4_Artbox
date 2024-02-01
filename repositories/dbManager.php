<?php

require_once 'dbConnect.php';

function getDb() {
  $db = dbConnection();
  return $db;
}

function getAllWorks() {
  $oeuvres = getDb()->query('SELECT * FROM artworks ORDER BY id ASC');
  return $oeuvres;
}

function getOneWork(int $id): array|bool {
  $sqlQuery = 'SELECT * FROM artworks WHERE id = :id';
  $req = getDb()->prepare($sqlQuery);
  $req->execute(['id' => $id]);
  $oeuvre = $req->fetch();

  return $oeuvre;
}

function addWork($workInfo) {
  $sqlQuery = 'INSERT INTO artworks (title, artist, description, imageUrl) VALUES (:titre, :artiste, :description, :image)';
  $req = getDb()->prepare($sqlQuery);
  $req->execute([
    'titre' => $workInfo['titre'],
    'artiste' => $workInfo['artiste'],
    'description' => $workInfo['description'],
    'image' => $workInfo['image']
  ]);

  return getDb()->lastInsertId();
}

