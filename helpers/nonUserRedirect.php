<?php
// wenn niemand eingeloggt ist, wird auf die startseite umgeleitet
if (!isset($_SESSION['user_id'])) {
  $_SESSION['error']['not-logged-in'] = 'Bitte loggen sie sich ein';
  header('Location: ' . '/');
  exit();
}