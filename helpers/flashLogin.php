<?php
if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
  foreach ($_SESSION['errors'] as $error) {
    echo '<p class="error-msg"><b>' . $error . '</b></p>';
  } 
}
unset($_SESSION['errors']);

if (isset($_SESSION['new-user'])) {
  echo '<p class="success-msg">' . $_SESSION['new-user'] . '</p>';
}
unset($_SESSION['new-user']);