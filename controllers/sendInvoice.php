<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/nonUserRedirect.php';

require_once __DIR__ . '/../lib/vendor/autoload.php';
require_once __DIR__ . '/../config/mail_data.php';
require_once __DIR__ . '/../helpers/sendMail.php';
require_once __DIR__ . '/../models/invoice.php';

$userId = $_SESSION['user_id'];
$orderId = $_SESSION['order_id'];
$userEmail = get_user_email_by_id($userId);

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$file = '/storage/' . $userId . '/' . $orderId . '.pdf';
$filePath = $rootPath . $file;

$orderDate = date('d.m.Y');

if (file_exists($filePath)) {

  $message = new Swift_Message('Bestellung vom ' . $orderDate);
  $message->setBody('Danke für ihre Bestellung, die Rechnung finden sie im Anhang.');
  $message->attach(Swift_Attachment::fromPath($filePath));
  $message->setTo($userEmail['email']);
  $message->setFrom([MAIL_NOREPLY => 'Stiftl | Rechnung']);
  $send = send_mail($message);
}

if (!file_exists($filePath)) {
  $_SESSION['error']['send-invoice-email'] = 'Fehler beim versenden der Email, bitte wenden sie sich an unser personal';
  header('Location: ' . '/views/thankyou.php');
}