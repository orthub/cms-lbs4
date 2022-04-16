<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../lib/vendor/autoload.php';
require_once __DIR__ . '/../config/mail_data.php';
require_once __DIR__ . '/../helpers/sendMail.php';

$registerDate = date('Y.m.d');
$token = hash('sha256', $registerDate);
$link = 'https://cms-lbs4.ddev.site/views/confirmedEmail.php?actoken=' . $token;
$_SESSION['register']['token'] = $token;

$newUserEmail = $_SESSION['registerEmail'];

$message = new Swift_Message('Stiftl - Account aktivierung');
$message->setBody('Um die Registrierung abzuschließen, klicken Sie bitte auf den Aktivierungslink. ' . 
$link);
$message->setTo($newUserEmail);
$message->setFrom([MAIL_NOREPLY => 'Stiftl | Account aktivierung']);
$send = send_mail($message);

if ($send) {
  header('Location: ' . '/views/confirmRegister.php');
  exit();
}

if (!$send) {
  $_SESSION['error']['activation-failed'] = 'Aktivierungslink konnte nicht verschickt werden.';
  header('Location: ' . '/views/register.php');
  exit();
}