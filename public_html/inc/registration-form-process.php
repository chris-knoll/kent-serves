<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
//require($_SERVER["DOCUMENT_ROOT"] . '/inc/utilities.inc.php');
require($_SERVER["DOCUMENT_ROOT"] . '/inc/db_functions/org-main-queries.php');
require($_SERVER["DOCUMENT_ROOT"] . '/inc/org-form-validation.php');
require($_SERVER["DOCUMENT_ROOT"] . '/inc/db_functions/new-user-queries.php');

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
  // Make sure the organization isn't already registered
  if(organizationWithGivenNameAlreadyExists($orgName)) {
     $submissionIsValid = false;
     $orgNameAlreadyRegistered = true;
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
  if(userAccountAlreadyExistsForEmail($mainContactEmail)) {
     $submissionIsValid = false;
     $accountExistsForGivenEmail = true;
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

  if($submissionIsValid) {
    $result = "Submission of " . $orgName . " successful";
    insertNewOrganization($orgName, $address, $orgPhone, $website, $facebook, $serviceArea,
                          $volunteer_need, $board_mem_need, $funding_need, $partnerships_need,
                          $space_need, $other_need, $mission);
    insertContactInfo($orgName, $mainContact, $mainContactEmail, $mainContactPhone,
                      $alternativeContact, $alternativeContactEmail, $alternativeContactPhone);


    // INSERT NEW USER BASED OFF THE MAIN CONTACT EMAIL ADDRESS
    $generatedPassword = getRandomPassword();
    $orgId = getOrganizationIdByMainContactEmail($mainContactEmail);
    insertNewUser($mainContactEmail, $orgId, $generatedPassword);

    // SEND EMAIL TO MAIN CONTACT EMAIL WITH RANDOM PASSWORD AND A LINK TO RESET THE PASSWORD
    $message = "Thank you for registering your organization with Kent Serves!  Please use the email address provided on the registration form as your login: " . $mainContactEmail . ".";
    $message .= "\n\nYou have been assigned a temporary password:\n" . $generatedPassword . "\n";
    $message .= "\nYou can log in to Kent Serves at any time at this url: http://kent-serves.greenrivertech.net/login.php";
    mail($mainContactEmail, "Kent Serves Login Information", $message);

    // DISPLAY THE SUCCESS MESSAGE
    include($_SERVER["DOCUMENT_ROOT"] . '/registration-success.php');

    } else { // If form was not valid...
      include($_SERVER["DOCUMENT_ROOT"] . '/register.php');
    }
}

function getRandomPassword() {
  $alphabet = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
  $pass = array(); //remember to declare $pass as an array
  $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
  for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
  }
  return implode($pass); //turn the array into a string
}

// Print functions to display errors to user
function printHeaderError() {
   echo "<p class='input-error'>There were one or more errors with your form input.  Please review the fields below.</p>";
}

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

function printAccountExistsForEmailError() {
   echo "<p class='input-error'>This email address already has a registered account associated with it.</p>";
}

function printOrgAlreadyRegisteredError() {
   echo "<p class='input-error'>That organization name has already been registered.</p>";
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
  if($alternativeContact) { // Only validate if there's something here
    if(!nameIsValid($alternativeContact)) {
      $alternativeContactNameIsInvalid = true;
      $submissionIsValid = false;
    }

    if(!emailAddressIsValid($alternativeContactEmail)) {
      $alternativeContactEmailIsInvalid = true;
      $submissionIsValid = false;
    }

    if(!phoneNumberIsValid($alternativeContactPhone)) {
      $alternativeContactPhoneIsInvalid = true;
      $submissionIsValid = false;
    }
  }

  if($submissionIsValid) {
    $result = "Submission of " . $orgName . " successful";
    insertNewOrganization($orgName, $address, $orgPhone, $website, $facebook, $serviceArea,
                          $volunteer_need, $board_mem_need, $funding_need, $partnerships_need,
                          $space_need, $other_need, $mission);
    insertContactInfo($orgName, $mainContact, $mainContactEmail, $mainContactPhone,
                      $alternativeContact, $alternativeContactEmail, $alternativeContactPhone);
  }
}

?>
