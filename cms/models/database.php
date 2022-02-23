<?php

// require_once __DIR__ . '/../config/config.php';

function get_db()
{
  static $db;
  if ($db instanceof PDO) {
    return $db;
  }
  $db = new PDO('mysql:host=db;port=3306;dbname=cms_shop', 'root', 'root');

  return $db;
}