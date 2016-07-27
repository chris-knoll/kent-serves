<?php

include('./inc/utilities.inc.php');

if ($user) {
  // Clear the variable
  $user = null;

  // Clear the session data:
  $_SESSION = array();

  // Clear the cookie:
  setcookie(session_name(), false, time()-3600);

  // Destroy session
  session_destroy();
}

header('Location: /login.php');
