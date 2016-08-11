<?php
require($_SERVER["DOCUMENT_ROOT"] . '/inc/utilities.inc.php');
require($_SERVER["DOCUMENT_ROOT"] . '/inc/db_functions/calendar-queries.php');
require($_SERVER["DOCUMENT_ROOT"] . '/inc/header.php');

// initialize fields
$eventTitle = "";
$eventLocation = "";
$Date = "";
$eventDescription = "";


if (isset($_POST['submit'])) {
  $submissionIsValid = true; // Set until proven otherwise
  $eventTitle = $_POST['inputEventTitle'];
  $eventLocation = $_POST['inputEventLocation'];
  $date = $_POST['inputdate'];
  $eventDescription = $_POST['inputEventDescription'];

  // Event validation
  if(empty($eventTitle)) {
    $eventTitleIsInvalid = true;
    $submissionIsValid = false;
  }

  if(empty($eventLocation)) {
    $eventLocationIsInvalid = true;
    $submissionIsValid = false;
  }

  if(empty($date)) {
    $eventDateIsInvalid = true;
    $submissionIsValid = false;
  }

  if(empty($eventDescription)) {
    $eventDescriptionIsInvalid = true;
    $submissionIsValid = false;
  }


  if($submissionIsValid) {
    $result = "Submission of " . $orgName . " successful";
    insertNewEvent($user->getOrgId(), $eventTitle, $eventLocation, convertDateToMySQL($date), $eventDescription);
    include($_SERVER["DOCUMENT_ROOT"] . '/event-add-success.php');
  } else {
    include($_SERVER["DOCUMENT_ROOT"] . '/events-form.php');
  }

}

function convertDateToMySQL($date) {
  $dateArray = explode("/", $date);
  return $dateArray[2] . "-" . $dateArray[0] . "-" . $dateArray[1];
}

// Print functions to display errors to user
function printTitleError() {
  echo "<p class='input-error'>Please enter event title.</p>";
}

function printLocationError() {
  echo "<p class='input-error'>Please enter location.</p>";
}

function printDateError() {
  echo "<p class='input-error'>Please select start date.</p>";
}

function printEventDescriptionError() {
  echo "<p class='input-error'>Please enter event description.</p>";
}

?>
