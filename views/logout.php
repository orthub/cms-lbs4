<?php
session_start();
unlink($_SESSION['userId']);
session_destroy();
header('Location: ' . '/');