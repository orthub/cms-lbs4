<?php
require_once __DIR__ . '/../config/db_conf.php';
function get_db()
{
  static $db;
  if ($db instanceof PDO) {
    return $db;
  }

  try {
    $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
    $user = DB_USER;
    $password = DB_PASSWD;
    $db = new PDO($dsn, $user, $password);
    // $db = new PDO('mysql:host=db;port=3306;dbname=cms_shop', 'root', 'root');
  } catch (\Exception $e) {
    
  }

  return $db;
}