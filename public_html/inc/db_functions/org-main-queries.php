<?php   
// REMOVE DB OBJECT LATER - THIS IS AN INCLUDES FILE
try {
  // instantiate a database object
  $dbh = new PDO("mysql:host=localhost; dbname=kentserv_organizations",
  "kentserv_user", "@pple!");
  echo "Connected to database!!";
}
catch(PDOException $e) {
  echo $e->getmessage();
}

function selectAllOrganizations() {
  global $dbh;

  $selectAllQuery = "SELECT * FROM kentserv_organizations.orgs_main";
  $statement = $dbh->prepare($selectAllQuery);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function insertNewOrganization($name, $address, $phone, $mainContact, $mainContactEmail, $mainContactPhone) {
  global $dbh;

  $deleteQuery = "INSERT into kentserv_organizations.orgs_main ";
  $deleteQuery .= "(org_name, address, org_phone, main_contact_name, main_contact_email, main_contact_phone) ";
  $deleteQuery .= "VALUES (:name, :address, :phone, :mainContact, :mainContactEmail, :mainContactPhone);";

  $statement = $dbh->prepare($deleteQuery);
  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':address', $address, PDO::PARAM_STR);
  $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
  $statement->bindParam(':mainContact', $mainContact, PDO::PARAM_STR);
  $statement->bindParam(':mainContactEmail', $mainContactEmail, PDO::PARAM_STR);
  $statement->bindParam(':mainContactPhone', $mainContactPhone, PDO::PARAM_STR);
  $statement->execute();
}

function removeOrganization($org_id) {
  $deleteQuery = "DELETE FROM kentserv_organizations.orgs_main WHERE id ='" + $org_id + "';";
  $statement = $dbh->prepare($deleteQuery);
  $statement->bindParam(':id', $org_id, PDO::PARAM_INT);
  $statement->execute();
}

?>
