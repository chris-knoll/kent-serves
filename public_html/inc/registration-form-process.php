<?php
require('db_functions/org-main-queries.php');
require('org-form-validation.php');

// initialize fields
$orgName = "";
$address = "";
$orgPhone = "";
$mission = "";
$mainContact = "";
$mainContactEmail = "";
$mainContactPhone = null;
$alternativeContact = null;
$alternativeContactEmail = null;
$alternativeContactPhone = null;
$website = null;
$facebook = null;
$orgNeeds[] = null;
$serviceArea = "";
$volunteer_need = 'N';
$board_mem_need = 'N';
$funding_need = 'N';
$partnerships_need = 'N';
$space_need = 'N';
$other_need = null;

if (isset($_POST['submit'])) {
  $submissionIsValid = true; // Set until proven otherwise
  $orgName = $_POST['inputOrganization'];
  $address = $_POST['inputAddress'];
  $mission = $_POST['inputMission'];
  $orgPhone = cleanPhoneNumber($_POST['inputPhone']);
  $mainContact = $_POST['inputMainContact'];
  $mainContactEmail = $_POST['inputMainContactEmail'];
  $mainContactPhone = cleanPhoneNumber($_POST['inputMainContactPhone']);
  $alternativeContact = $_POST['inputAlternativeContact'];
  $alternativeContactEmail = $_POST['inputAlternativeContactEmail'];
  $alternativeContactPhone = cleanPhoneNumber($_POST['inputAlternativeContactPhone']);
  $website = $_POST['inputWebsite'];
  $facebook = $_POST['inputFacebook'];
  $serviceArea = $_POST['selectService'];
  $orgNeeds[] = $_POST['checkBoxList[]'];

  if (isset($_POST['volunteerNeed'])) {
    $volunteer_need = 'Y';
  }
  if (isset($_POST['boardMemNeed'])) {
    $board_mem_need = 'Y';
  }
  if (isset($_POST['fundingNeed'])) {
    $funding_need = 'Y';
  }
  if (isset($_POST['partnershipsNeed'])) {
    $partnerships_need = 'Y';
  }
  if (isset($_POST['spaceNeed'])) {
    $space_need = 'Y';
  }
  if (isset($_POST['otherNeed'])) {
    $other_need = $_POST['otherNeedDetails'];
  }

  // Organization validation
  if(!nameIsValid($orgName)) {
    $orgNameIsInvalid = true;
    $submissionIsValid = false;
  }
  if(!phoneNumberIsValid($orgPhone)) {
    $orgPhoneIsInvalid = true;
    $submissionIsValid = false;
  }
  if(empty($mission)) {
    $orgMissionIsInvalid = true;
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
  if ($mainContactPhone) {
     if(!phoneNumberIsValid($mainContactPhone)) {
      $mainContactPhoneIsInvalid = true;
      $submissionIsValid = false;
    }
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
    $result = "Submission of " . $orgName . " successful";
    insertNewOrganization($orgName, $address, $orgPhone, $website, $facebook, $serviceArea,
                          $volunteer_need, $board_mem_need, $funding_need, $partnerships_need,
                          $space_need, $other_need, $mission);
    insertContactInfo($orgName, $mainContact, $mainContactEmail, $mainContactPhone,
                      $alternativeContact, $alternativeContactEmail, $alternativeContactPhone);
    //header("Location: http://kent-serves.greenrivertech.net/partnerstable.php");
    
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

function printMissionError() {
  echo "<p class='input-error'>Please enter a mission statement.</p>";
}



// EDIT ORGANIZATION PROCESSING

if (isset($_POST['submitChanges'])) {
  $submissionIsValid = true; // Set until proven otherwise
  $orgName = $_POST['inputOrganization'];
  $address = $_POST['inputAddress'];
  $mission = $_POST['inputMission'];
  $orgPhone = cleanPhoneNumber($_POST['inputPhone']);
  $mainContact = $_POST['inputMainContact'];
  $mainContactEmail = $_POST['inputMainContactEmail'];
  $mainContactPhone = cleanPhoneNumber($_POST['inputMainContactPhone']);
  $alternativeContact = $_POST['inputAlternativeContact'];
  $alternativeContactEmail = $_POST['inputAlternativeContactEmail'];
  $alternativeContactPhone = cleanPhoneNumber($_POST['inputAlternativeContactPhone']);
  $website = $_POST['inputWebsite'];
  $facebook = $_POST['inputFacebook'];
  $serviceArea = $_POST['selectService'];
  $orgNeeds[] = $_POST['checkBoxList[]'];

  if (isset($_POST['volunteerNeed'])) {
    $volunteer_need = 'Y';
  }
  if (isset($_POST['boardMemNeed'])) {
    $board_mem_need = 'Y';
  }
  if (isset($_POST['fundingNeed'])) {
    $funding_need = 'Y';
  }
  if (isset($_POST['partnershipsNeed'])) {
    $partnerships_need = 'Y';
  }
  if (isset($_POST['spaceNeed'])) {
    $space_need = 'Y';
  }
  if (isset($_POST['otherNeed'])) {
    $other_need = $_POST['otherNeedDetails'];
  }

  // Organization validation
  if(!nameIsValid($orgName)) {
    $orgNameIsInvalid = true;
    $submissionIsValid = false;
  }
  if(!phoneNumberIsValid($orgPhone)) {
    $orgPhoneIsInvalid = true;
    $submissionIsValid = false;
  }
  if(empty($mission)) {
    $orgMissionIsInvalid = true;
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
  if ($mainContactPhone) {
     if(!phoneNumberIsValid($mainContactPhone)) {
      $mainContactPhoneIsInvalid = true;
      $submissionIsValid = false;
    }
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
    $result = "Submission of " . $orgName . " successful";
    insertNewOrganization($orgName, $address, $orgPhone, $website, $facebook, $serviceArea,
                          $volunteer_need, $board_mem_need, $funding_need, $partnerships_need,
                          $space_need, $other_need, $mission);
    insertContactInfo($orgName, $mainContact, $mainContactEmail, $mainContactPhone,
                      $alternativeContact, $alternativeContactEmail, $alternativeContactPhone);
    //header("Location: http://kent-serves.greenrivertech.net/partnerstable.php");
    
  }
}

?>
