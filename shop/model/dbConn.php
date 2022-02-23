<?php

function get_db()
{
  static $db;
  if ($db instanceof PDO) {
    return $db;
  }

  $db = new PDO('mysql:host=db;port=3306;dbname=db', 'db', 'db');

  return $db;
}