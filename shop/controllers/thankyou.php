<?php
session_start();

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}


var_dump($_POST['deliveryId']);