<?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
  foreach ($_SESSION['error'] as $error) {
    echo '<p class="error-msg"><b>' . $error . '</b></p>';
  } 
}
if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
  foreach ($_SESSION['success'] as $success) {
    echo '<p class="success-msg">' . $success . '</p>';
  }
}

unset($_SESSION['error']);
unset($_SESSION['success']);