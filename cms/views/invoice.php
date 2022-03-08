<?php
namespace Dompdf;
echo 'Rechnung';
// reference the Dompdf namespace
#use Dompdf\Dompdf;
require_once __DIR__ . '/../../lib/vendor/dompdf/dompdf/src/Autoloader.php';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

