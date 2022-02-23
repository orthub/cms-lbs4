<?php

require_once __DIR__ . '/function.php';

$a = 1;
$b = true;
$c = [];
$d = NULL;
$e = '';
$f = 12.102;

echo '$a = ' . gettype($a) . '<br />';
echo '$b = ' . gettype($b) . '<br />';
echo '$c = ' . gettype($c) . '<br />';
echo '$d = ' . gettype($d) . '<br />';
echo '$e = ' . gettype($e) . '<br />';
echo '$f = ' . gettype($f) . '<br />';

$booltest = true;
echo 'Booltest from function: ' . gettype(is_boolean($booltest)) . '<br />';

if ($booltest === true) {
  echo 'Booltest is true ===<br />';
  echo 'Type: ' . gettype($booltest) . '<br />';
}
if ($booltest == true) {
  echo 'Booltest is true ==<br />';
  echo 'Type: ' . gettype($booltest) . '<br />';
}
if (is_boolean($booltest) === true) {
  echo 'Function booltest === true<br />';
  echo 'Type: ' . gettype($booltest) . '<br />';
}

echo 'echo $booltest: ' . $booltest . '<br />';

$users = get_users();
var_dump($users);