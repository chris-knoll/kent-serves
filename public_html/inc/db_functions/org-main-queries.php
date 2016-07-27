<?php
//require('../../../db.php');
try {
      // instantiate a database object
      $dbh = new PDO("mysql:host=localhost; dbname=kentserv_organizations",
      "kentserv_user", "@pple!");
    }
    catch(PDOException $e) {
      echo $e->getmessage();
    }

// Returns all organizations
function getAllOrganizations() {
  global $dbh;
  
  $selectAllQuery = "SELECT * FROM kentserv_organizations.orgs_main";
  $statement = $dbh->prepare($selectAllQuery);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  
  return $result;
}

// Returns contact info of all organizations
function getAllOrganizationsContact() {
  global $dbh;
  
  $selectAllQuery = "SELECT * FROM kentserv_organizations.orgs_main";
  $statement = $dbh->prepare($selectAllQuery);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  
  return $result;
}

// Returns a single organization associated with the given ID
function getSingleOrganization($org_id) {
  global $dbh;

  $selectQuery = "SELECT * FROM kentserv_organizations.orgs_main WHERE org_id=" . $org_id . " LIMIT 1;";
  $statement = $dbh->prepare($selectQuery);
  $statement->execute();
  $result = $statement->fetch();
  
  return $result;
}

// Get contact info of organization associated with given ID
function getContactInfo($org_id) {
  global $dbh;
  $selectQuery = "SELECT * FROM kentserv_organizations.orgs_contact WHERE org_id=" . $org_id . " LIMIT 1;";
  $statement = $dbh->prepare($selectQuery);
  $statement->execute();
  $result = $statement->fetch();
  return $result;
}

// Inserts a new organization with the given details into the orgs_main table
function insertNewOrganization($name, $address, $phone, $website, $facebook, $serviceArea,
							   $volunteer_need, $board_mem_need, $funding_need, $partnerships_need,
							   $space_need, $other_need, $mission) {
  global $dbh;
  
  $insertQuery = "INSERT into kentserv_organizations.orgs_main ";
  $insertQuery .= "(org_name, address, org_phone, website, facebook, service_area, volunteer_need, ";
  $insertQuery .= "board_mem_need, funding_need, partnerships_need, space_need, other_need, mission) ";
  $insertQuery .= "VALUES (:name, :address, :phone, :website, :fb, :service, :vneed, ";
  $insertQuery .= ":bmemneed, :fndneed, :psneed, :spneed, :oneed, :mission)";

  $statement = $dbh->prepare($insertQuery);
  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':address', $address, PDO::PARAM_STR);
  $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
  $statement->bindParam(':website', $website, PDO::PARAM_STR);
  $statement->bindParam(':fb', $facebook, PDO::PARAM_STR);
  $statement->bindParam(':service', $serviceArea, PDO::PARAM_STR);
  $statement->bindParam(':vneed', $volunteer_need, PDO::PARAM_STR);
  $statement->bindParam(':bmemneed', $board_mem_need, PDO::PARAM_STR);
  $statement->bindParam(':fndneed', $funding_need, PDO::PARAM_STR);
  $statement->bindParam(':psneed', $partnerships_need, PDO::PARAM_STR);
  $statement->bindParam(':spneed', $space_need, PDO::PARAM_STR);
  $statement->bindParam(':oneed', $other_need, PDO::PARAM_STR);
  $statement->bindParam(':mission', $mission, PDO::PARAM_STR);
  $statement->execute();
}

// Inserts contact information with the given details into the orgs_contact table
function insertContactInfo($name, $mainContact, $mainContactEmail, $mainContactPhone,
							   $altContact, $altContactEmail, $altContactPhone) {
  global $dbh;
  
  // get the id of the row in orgs_main of the associated organization
  $selectQuery = "SELECT * FROM kentserv_organizations.orgs_main WHERE org_name='" . $name . "' LIMIT 1;";
  $statement = $dbh->prepare($selectQuery);
  $statement->execute();
  $result = $statement->fetch();
  $org_id = $result['org_id'];

  $insertQuery = "INSERT into kentserv_organizations.orgs_contact ";
  $insertQuery .= "(org_id, main_contact_name, main_contact_email, main_contact_phone, " .
	"alt_contact_name, alt_contact_email, alt_contact_phone) ";
  $insertQuery .= "VALUES (:id, :mc, :mcEmail, :mcPhone, :alt, :altEmail, :altPhone);";

  $statement = $dbh->prepare($insertQuery);
  $statement->bindParam(':id', $org_id, PDO::PARAM_STR);
  $statement->bindParam(':mc', $mainContact, PDO::PARAM_STR);
  $statement->bindParam(':mcEmail', $mainContactEmail, PDO::PARAM_STR);
  $statement->bindParam(':mcPhone', $mainContactPhone, PDO::PARAM_STR);
  $statement->bindParam(':alt', $altContact, PDO::PARAM_STR);
  $statement->bindParam(':altEmail', $altContactEmail, PDO::PARAM_STR);
  $statement->bindParam(':altPhone', $altContactPhone, PDO::PARAM_STR);
  $statement->execute();
}

// Updates an organization with the given details in the orgs_main table
function editOrganization($id, $name, $address, $phone, $website, $facebook, $serviceArea,
							   $volunteer_need, $board_mem_need, $funding_need, $partnerships_need,
							   $space_need, $other_need, $mission) {
  global $dbh;
  
  $updateQuery = "UPDATE orgs_main SET org_name = :name, address = :address, org_phone = :phone, ";
  $updateQuery .= "website = :web, facebook = :fb, service_area = :svcarea, volunteer_need = :vneed, ";
  $updateQuery .= "board_mem_need = :bmemneed, funding_need = :fndneed, partnerships_need = :psneed, ";
  $updateQuery .= "space_need = :spneed, other_need = :oneed, mission = :mission WHERE org_id = :id;";

  $statement = $dbh->prepare($updateQuery);
  $statement->bindParam(':id', $id, PDO::PARAM_STR);
  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':address', $address, PDO::PARAM_STR);
  $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
  $statement->bindParam(':web', $website, PDO::PARAM_STR);
  $statement->bindParam(':fb', $facebook, PDO::PARAM_STR);
  $statement->bindParam(':svcarea', $serviceArea, PDO::PARAM_STR);
  $statement->bindParam(':vneed', $volunteer_need, PDO::PARAM_STR);
  $statement->bindParam(':bmemneed', $board_mem_need, PDO::PARAM_STR);
  $statement->bindParam(':fndneed', $funding_need, PDO::PARAM_STR);
  $statement->bindParam(':psneed', $partnerships_need, PDO::PARAM_STR);
  $statement->bindParam(':spneed', $space_need, PDO::PARAM_STR);
  $statement->bindParam(':oneed', $other_need, PDO::PARAM_STR);
  $statement->bindParam(':mission', $mission, PDO::PARAM_STR);
  $statement->execute();
}

// Updates contact information with the given details in the orgs_contact table
function editContactInfo($org_id, $name, $mainContact, $mainContactEmail, $mainContactPhone,
							   $altContact, $altContactEmail, $altContactPhone) {
  global $dbh;
  
  $updateQuery = "UPDATE orgs_contact SET main_contact_name = :mc, main_contact_email = :mcEmail, ";
  $updateQuery .= "main_contact_phone = :mcPhone, alt_contact_name = :alt, alt_contact_email = :altEmail, ";
  $updateQuery .= "alt_contact_phone = :altPhone WHERE org_id = :id;";

  $statement = $dbh->prepare($updateQuery);
  $statement->bindParam(':id', $org_id, PDO::PARAM_STR);
  $statement->bindParam(':mc', $mainContact, PDO::PARAM_STR);
  $statement->bindParam(':mcEmail', $mainContactEmail, PDO::PARAM_STR);
  $statement->bindParam(':mcPhone', $mainContactPhone, PDO::PARAM_STR);
  $statement->bindParam(':alt', $altContact, PDO::PARAM_STR);
  $statement->bindParam(':altEmail', $altContactEmail, PDO::PARAM_STR);
  $statement->bindParam(':altPhone', $altContactPhone, PDO::PARAM_STR);
  $statement->execute();
}

// Removes an organization from orgs_main and orgs_contact
function removeOrganization($org_id) {
  $deleteQuery = "DELETE FROM kentserv_organizations.orgs_main WHERE org_id=" + $org_id + ";";
  $statement = $dbh->prepare($deleteQuery);
  $statement->bindParam(':id', $org_id, PDO::PARAM_INT);
  $statement->execute();
  $deleteQuery = "DELETE FROM kentserv_organizations.orgs_contact WHERE org_id=" + $org_id + ";";
  $statement = $dbh->prepare($deleteQuery);
  $statement->bindParam(':id', $org_id, PDO::PARAM_INT);
  $statement->execute();
}

// Builds a table that displays all organizations in the org_main DB table
function buildPartnersTable() {
  $allOrganizations = getAllOrganizations();
  $allContactInfo = getAllOrganizationsContact();

  // Display a row for each organization registered.
  foreach($allOrganizations as $row) {
	
    // Assign results to variables
    $org_id = htmlentities($row['org_id']);
	$contactInfo = getContactInfo($org_id);
    $orgName = htmlentities($row['org_name']);
    $mainContactName = htmlentities($contactInfo['main_contact_name']);
    $mainContactEmail = htmlentities($contactInfo['main_contact_email']);

  	// Generate a unique URL for each organization
  	$url = "org_details.php?" . http_build_query(array('id'=>$org_id));
	
  	echo "<tr>";
  	echo "<td class='orgNameCol'><a href='$url'>" . $orgName . "</a></td>";
  	echo "<td class='contactCol'>" . $mainContactName . "</td>";
  	echo "<td class='emailCol'>" . $mainContactEmail . "</td>";
	if ($user && $user->isAdmin()) {
	  echo "<td class='adminTableView'>";
	  $actions = "<a class='deleteOrganization' href='/inc/db_functions/delete-organization.php?rowId=" . $org_id . "'>Delete</a>";
	  $actions .= "<a class='editOrganization' href='edit_profile.php?" . $org_id . "'>Edit</a>";
	  echo $actions;
	  echo "</td>";
	}	
  	echo "</tr>";
  }
}

function getNeedAreas($org_id) {
  $thisOrganization = getSingleOrganization($org_id);
  $needs = [];
  if ($thisOrganization['volunteer_need'] == 'Y') {
	$needs[] = "Volunteers";
  }
  if ($thisOrganization['board_mem_need'] == 'Y') {
	$needs[] = "Board Members";
  }
  if ($thisOrganization['funding_need'] == 'Y') {
	$needs[] = "Funding";
  }
  if ($thisOrganization['partnerships_need'] == 'Y') {
	$needs[] = "Partnerships/Collaboration";
  }
  if ($thisOrganization['space_need'] == 'Y') {
	$needs[] = "Meeting Space";
  }
  if ($thisOrganization['other_need'] != null) {
	$needs[] = $thisOrganization['other_need'];
  }
  return $needs;
}

function displayContactInfo($org_id) {
  $thisOrganization = getSingleOrganization($org_id);
  $contactInfo = getContactInfo($org_id);

  // general details
  echo "<p class='detail-text'>" . $thisOrganization['org_name'] . "<br>";
  echo $thisOrganization['address'] . "<br>"; 
  echo $thisOrganization['org_phone'] . "</p>";
  
  if ($thisOrganization['website']) {
	echo "<p class='detail-text'>Website: <a href='" . $thisOrganization['website'] . "'>" .
		$thisOrganization['website'] . "</a></p>";
  }
  if ($thisOrganization['facebook']) {
	echo "<p class='detail-text'>Facebook: <a href='" . $thisOrganization['facebook'] . "'>" .
		$thisOrganization['facebook'] . "</a></p>";
  }
  
  // primary contact
  echo "<p class='detail-text'>Primary Contact:<br>";
  echo $contactInfo['main_contact_name'] . "<br>";
  echo $contactInfo['main_contact_email'] . "<br>";
  if ($contactInfo['main_contact_phone']) {
	echo prettyPhoneNumber($contactInfo['main_contact_phone']);
  }
  echo "</p>";
  
  // alternative contact
  if ($contactInfo['alt_contact_name'] || $contactInfo['alt_contact_email'] ||
	  $contactInfo['alt_contact_phone']) {
	echo "<p class='detail-text'>Alternative Contact:<br>";
	if ($contactInfo['alt_contact_name']) {
	  echo $contactInfo['alt_contact_name'] . "<br>";
	}
	if ($contactInfo['alt_contact_email']) {
	  echo $contactInfo['alt_contact_email'] . "<br>";
	}
	if ($contactInfo['alt_contact_phone']) {
	  echo prettyPhoneNumber($contactInfo['alt_contact_phone']);
	}
	echo "</p>";
  }
  
}


// Displays an edit button if conditions are met
function editButton($org_id) {
  // "if user is logged in AND the organization belongs to his/her account"a
  $url = "edit_profile.php?" . http_build_query(array('id'=>$org_id));
  echo "<a href='$url'><button id='editOrgDetails' class='btn btn-default pull-right'>Edit Profile</button></a>";
}

function editOrg($org_id) {
  // redirect to edit page
}

function prettyPhoneNumber($phoneNumber) {
  return "(".substr($phoneNumber, 0, 3).") ".substr($phoneNumber, 3, 3)."-".substr($phoneNumber,6);
}

?>
