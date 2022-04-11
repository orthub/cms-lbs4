<?php
namespace Dompdf;

require_once __DIR__ . '/../lib/sessionHelper.php';
if (!isset($_SESSION['userId'])) {
  die('Zuerst <a href="/views/login.php">einloggen</a>');
}


use Dompdf\Dompdf;
use Dompdf\Adapter\CPDF;
use Dompdf\Exception;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/dompdf/dompdf/src/Autoloader.php';
require_once __DIR__ . '/../controllers/invoicePDF.php';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$endprice = 0;

// produkte für tabelle generieren + gesamtpreis
foreach ($_SESSION['products-from-order'] as $value) {
  $products .= '<tr>
                  <td class="text-left">' . $value['title'] . '</td>
                  <td class="text-left">' . $value['quantity'] . '</td>
                  <td class="text-left">' . $value['price'] / 100 . '</td>' .
              '</tr>';
  $price = $value['price'] * $value['quantity'];
  $endprice = $endprice + $price;
}

// HTML für die Erstellung des PDF-Dokuments
$renderToHTML ='
<html>
<head>
  <style>
    html, body {margin: 0;padding:0}
    body {height: 100%;}
    table {}
    h1 {font-size: 32px}
    h2 {font-size: 24px}
    p {font-size: 16px}
    th, td {padding: 6px 10px}
    .content {margin: 2cm 1.5cm 1.5cm 2cm;}
    .text-left {text-align: left;}
    .text-center {text-align: center}
    .text-right {text-align: right}
    .float-left {float:left;}
    .footer {position:absolute; width:100%; bottom: 190px;}
  </style>
</head>
<body>
  <div class="content">
    <h1>Rechnung:</h1>
    <hr />
    <p>Bestell Nummer: <b>' . $_SESSION["base-order"]["orders_id"] . '</b></p>
    <p>Bestell Datum: <b>' . $_SESSION['base-order']['order_date'] . '</b></p>
    <p>Bestell Status: <b>' .  $_SESSION['base-order']['status'] . '</b></p>
    <hr />
    <h2>Produkte:</h2>
    <table>
      <thead>
        <tr>
          <th class="text-left">Produkt</th>
          <th class="text-left">Stück</th>
          <th class="text-left">Preis</th>
        </tr>
      </thead>
      <tbody>
      ' . $products . '
      </tbody>
      </table>
      <div class="text-right">
        <p>Gesamtpreis:(inkl. MwSt)</p>
        <p>' . $endprice / 100 . '€</p>
      <div>
    <p class="text-left">Bitte berücksichtigen sie, dass die Versendung der Waren erst nach eingelangter Zahlung auf unser Konto erfolgt.</p>
    <p class="text-left">Benutzen sie für die Überweisung als Verwendungszweck: ' .$_SESSION["base-order"]["orders_id"] . '</p>
    <div class="footer">
      <hr />
      <div class="float-left text-center">
        <p>Firma Stiftl GmbH</p>
        <p>Stiftlstraße 1</p>
        <p>1299 Stiftlingen</p>
      <div>
      <div class="float-left text-center">
        <p>Firma Stiftl GmbH</p>
        <p>Stiftlstraße 1</p>
        <p>1299 Stiftlingen</p>
      <div>
      <div class="float-left text-center">
        <p>Firma Stiftl GmbH</p>
        <p>Stiftlstraße 1</p>
        <p>1299 Stiftlingen</p>
      <div>
    </div>
  </div>
</body>
</html>
';

$dompdf->loadHtml($renderToHTML);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

$output = $dompdf->output();

file_put_contents('../storage/test.pdf', $output);