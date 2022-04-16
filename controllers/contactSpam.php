<?php
require_once __DIR__ . '/../helpers/session.php';

$number1 = rand(1, 9);
$number2 = rand(1, 9);
$choose_calculation = rand(0, 1);
$calculation = ['+', '*'];

switch ($choose_calculation) {
  case 0:
    $calc = $number1 + $number2;
    break;
  case 1:
    $calc = $number1 * $number2;
    break;
}

$spam_protect = $number1 . ' ' . $calculation[$choose_calculation] . ' ' . $number2;
$_SESSION['contact']['spam'] = $spam_protect;
$_SESSION['contact']['result'] = $calc;