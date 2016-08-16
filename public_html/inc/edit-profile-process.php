<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
// populate fields with current data
$orgName = $thisOrganization['org_name'];
$address = $thisOrganization['address'];
$orgPhone = $thisOrganization['org_phone'];
$mainContact = $thisOrganizationContact['main_contact_name'];
$mainContactEmail = $thisOrganizationContact['main_contact_email'];
$mainContactPhone = $thisOrganizationContact['main_contact_phone'];
$alternativeContact = $thisOrganizationContact['alt_contact_name'];
$alternativeContactEmail = $thisOrganizationContact['alt_contact_email'];
$alternativeContactPhone = $thisOrganizationContact['alt_contact_phone'];
$website = $thisOrganization['website'];
$facebook = $thisOrganization['facebook'];
$serviceArea = $thisOrganization['service_area'];
$volunteer_need = $thisOrganization['volunteer_need'];
$board_mem_need = $thisOrganization['board_mem_need'];
$funding_need = $thisOrganization['funding_need'];
$partnerships_need = $thisOrganization['partnerships_need'];
$space_need = $thisOrganization['space_need'];
$other_need = $thisOrganization['other_need'];
$mission = $thisOrganization['mission'];

// EDIT ORGANIZATION

if (isset($_POST['submitChanges'])) {
  $submissionIsValid = true; // Set until proven otherwise
  $orgName = $_POST['editOrganization'];
  $address = $_POST['editAddress'];
  $mission = $_POST['editMission'];
  $orgPhone = cleanPhoneNumber($_POST['editPhone']);
  $mainContact = $_POST['editMainContact'];
  $mainContactEmail = $_POST['editMainContactEmail'];
  $mainContactPhone = cleanPhoneNumber($_POST['editMainContactPhone']);
  $alternativeContact = $_POST['editAlternativeContact'];
  $alternativeContactEmail = $_POST['editAlternativeContactEmail'];
  $alternativeContactPhone = cleanPhoneNumber($_POST['editAlternativeContactPhone']);
  $website = $_POST['editWebsite'];
  $facebook = $_POST['editFacebook'];
  $serviceArea = $_POST['editSelectService'];
  $orgNeeds[] = $_POST['checkBoxList[]'];

  if (isset($_POST['editVolunteerNeed'])) {
    $volunteer_need = 'Y';
  } else {
    $volunteer_need = 'N';
  }
  if (isset($_POST['editBoardMemNeed'])) {
    $board_mem_need = 'Y';
  } else {
    $board_mem_need = 'N';
  }
  if (isset($_POST['editFundingNeed'])) {
    $funding_need = 'Y';
  } else {
    $funding_need = 'N';
  }
  if (isset($_POST['editPartnershipsNeed'])) {
    $partnerships_need = 'Y';
  } else {
    $partnerships_need = 'N';
  }
  if (isset($_POST['editSpaceNeed'])) {
    $space_need = 'Y';
  } else {
    $space_need = 'N';
  }
  if (isset($_POST['editOtherNeed'])) {
    $other_need = $_POST['editOtherNeedDetails'];
  } else {
    $other_need = null;
  }

  // Check if the logged in user has permission to edit this organization:
  if (!$user->canEditOrg($_GET['id'])) {
    $submissionIsValid = false;
    $result = "You do not have permission to edit this organization.";
  }

  // Organization validations
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
    $result = "Update of " . $orgName . " successful. ";
    $result .= "<a href='org_details.php?id=" . $org_id . "'>View Profile >>></a>";
    editOrganization($org_id, $orgName, $address, $orgPhone, $website, $facebook, $serviceArea,
                          $volunteer_need, $board_mem_need, $funding_need, $partnerships_need,
                          $space_need, $other_need, $mission);
    editContactInfo($org_id, $orgName, $mainContact, $mainContactEmail, $mainContactPhone,
                      $alternativeContact, $alternativeContactEmail, $alternativeContactPhone);
    //header("Location: http://kent-serves.greenrivertech.net/partnerstable.php");

  }
}

// Returns true if email address is valid
function emailAddressIsValid($emailAddress) {
  return filter_var($emailAddress, FILTER_VALIDATE_EMAIL);
}

// Returns true if name is not empty and only has alpha characters
function nameIsValid($name) {
  return !empty($name) && ctype_alpha(str_replace(' ', '', $name));
}

// Returns true if phone number is valid
function phoneNumberIsValid($phoneNumber) {
  // Returns true if our cleaned phone number has 10 digits
  return strlen($phoneNumber) == 10;
}

function cleanPhoneNumber($phoneNumber) {
  $cleanedPhoneNumber = preg_replace("/[^0-9]/", '', $phoneNumber);
  //eliminate leading 1 if its there
  if (strlen($cleanedPhoneNumber) == 11) {
    $cleanedPhoneNumber = preg_replace("/^1/", '', $cleanedPhoneNumber);
  }

  return $cleanedPhoneNumber;
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

?>
