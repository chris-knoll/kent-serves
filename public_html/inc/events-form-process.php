<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
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
