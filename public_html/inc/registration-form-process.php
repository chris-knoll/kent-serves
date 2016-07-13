<?php
require('db_functions/org-main-queries.php');
require('org-form-validation.php');

// initialize fields
$orgName = "";
$address = "";
$orgPhone = "";
$mainContact = "";
$mainContactEmail = "";
$mainContactPhone = "";

if (isset($_POST['submit'])) {
  $submissionIsValid = true; // Set until proven otherwise
  $orgName = $_POST['inputOrganization'];
  $address = $_POST['inputAddress'];
  $orgPhone = cleanPhoneNumber($_POST['inputPhone']);
  $mainContact = $_POST['inputMainContact'];
  $mainContactEmail = $_POST['inputMainContactEmail'];
  $mainContactPhone = cleanPhoneNumber($_POST['inputMainContactPhone']);
  $alternativeContact = $_POST['inputAlternativeContact'];
  $alternativeContactEmail = $_POST['inputAlternativeContactEmail'];
  $alternativeContactPhone = cleanPhoneNumber($_POST['inputAlternativeContactPhone']);

  // Organization validation
  if(!nameIsValid($orgName)) {
    $orgNameIsInvalid = true;
    $submissionIsValid = false;
  }
  if(!phoneNumberIsValid($orgPhone)) {
    $orgPhoneIsInvalid = true;
    $submissionIsValid = false;
  }
  if(!$address) {
    $orgAddressIsInvalid = true;
    $submissionIsValid = false;
  }

  // Main contact validation
  if(!nameIsValid($mainContact)) {
    $mainContactNameIsInvalid = true;
    $submissionIsValid = false;
  }
  if(!emailAddressIsValid($mainContactEmail)) {
    $mainContactEmailIsInvalid = true;
    $submissionIsValid = false;
  }
  if(!phoneNumberIsValid($mainContactPhone)) {
    $mainContactPhoneIsInvalid = true;
    $submissionIsValid = false;
  }

  //Alternative contact validation
  if($alternativeContact) {
    if(!nameIsValid($alternativeContact)) {
      $alternativeContactNameIsInvalid = true;
      $submissionIsValid = false;
    }
  }
  if($alternativeContactEmail) {
    if(!emailAddressIsValid($alternativeContactEmail)) {
      $alternativeContactEmailIsInvalid = true;
      $submissionIsValid = false;
    }
  }
  if($alternativeContactPhone) {
    if(!phoneNumberIsValid($alternativeContactPhone)) {
      $alternativeContactPhoneIsInvalid = true;
      $submissionIsValid = false;
    }
  }


  /* empty fields
  $orgName = "";
  $address = "";
  $orgPhone = "";
  $mainContact = "";
  $mainContactEmail = "";
  $mainContactPhone = "";*/
  if($submissionIsValid) {
    $result = "Submission successful";
    insertNewOrganization($orgName, $address, $orgPhone, $mainContact, $mainContactEmail, $mainContactPhone);
    header("Location: http://kent-serves.greenrivertech.net/partnerstable.php");
  }
}

// Print functions to display errors to user
function printPhoneError() {
  echo "<p class='input-error'>Please enter a valid phone number with area code.</p>";
}

function printNameError() {
  echo "<p class='input-error'>Please enter a valid name with letters only.</p>";
}

function printEmailError() {
  echo "<p class='input-error'>Please enter a valid e-mail address.</p>";
}

function printAddressError() {
  echo "<p class='input-error'>Please enter a valid address.</p>";
}

?>
