<?php

function is_boolean($booltest_var): bool
{
  if ($booltest_var === true) {
    return true;
  }
  return false;
}

function get_db()
{
  static $db;
  if ($db instanceof PDO) {
    return $db;
  }

  $db = new PDO('mysql:host=db;port=3306;dbname=db', 'db', 'db');

  return $db;
}

function get_users()
{
  $sql = 'SELECT * FROM user';
  $stmt = get_db()->prepare($sql);
  $stmt->execute();
  if ($stmt === true) {
    return $stmt->fetchAll();
  }
  return false;
}