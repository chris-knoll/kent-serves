<?php

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
