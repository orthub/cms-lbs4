<?php
session_start();
unlink($_SESSION['user_id']);
session_destroy();
header('Location: ' . '/');