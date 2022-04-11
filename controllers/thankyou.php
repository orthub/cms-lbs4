<?php
require_once __DIR__ . '/../lib/sessionHelper.php';

if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}