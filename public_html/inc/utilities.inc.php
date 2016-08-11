<?php
// Autoload classes from "classes" Directory
function class_loader($class) {
  require($_SERVER["DOCUMENT_ROOT"]  . '/classes/' . $class . '.php');
}
spl_autoload_register('class_loader');

// Start the session to store user logged in
session_start();

// Check for a user in the session.
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
