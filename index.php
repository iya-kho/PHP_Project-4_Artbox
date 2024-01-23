<?php
require_once 'views/header.php'; 

require_once 'models/dbManager.php';
$oeuvres = getAllWorks();

require_once 'views/home.php';

require_once 'views/footer.php';