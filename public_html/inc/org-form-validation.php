<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/

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
