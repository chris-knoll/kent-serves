<?php

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
