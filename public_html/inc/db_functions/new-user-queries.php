<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/

// Returns the ID of the related organization when passed the main contact email
function getOrganizationIdByMainContactEmail($email) {
  global $dbh;

  $selectQuery = "SELECT org_id FROM kentserv_organizations.orgs_contact WHERE main_contact_email='" . $email . "' LIMIT 1;";
  $statement = $dbh->prepare($selectQuery);
  $statement->execute();
  $result = $statement->fetch();

  return $result['org_id'];
}

// Inserts a new user - done when register.php is successfully filled out
function insertNewUser($email, $orgId, $unencryptedPassword) {
  global $dbh;

  $insertQuery = "INSERT into kentserv_organizations.users ";
  $insertQuery .= "(email, org_id, user_type, password) ";
  $insertQuery .= "VALUES (:email, :orgId, 'organization', :unencryptedPassword)";

  $statement = $dbh->prepare($insertQuery);
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':orgId', $orgId, PDO::PARAM_STR);
  $statement->bindParam(':unencryptedPassword', sha1($unencryptedPassword), PDO::PARAM_STR);
  $statement->execute();
}

function userAccountAlreadyExistsForEmail($email) {
   global $dbh;
   $selectQuery = "SELECT email FROM kentserv_organizations.users WHERE email='" . $email . "' LIMIT 1;";
   $statement = $dbh->prepare($selectQuery);
   $statement->execute();
   $result = $statement->fetch();
   if($result) {
      return true;
   } else {
      return false;
   }
}
