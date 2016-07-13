<?php
//require('../../assets/js/org-table-events.js');
try {
  // instantiate a database object
  $dbh = new PDO("mysql:host=localhost; dbname=kentserv_organizations",
  "kentserv_user", "@pple!");
}
catch(PDOException $e) {
  echo $e->getmessage();
}

$org_id = $_GET['rowId'];
//echo "<script type='text/javascript'>alert('in php file: $org_id');</script>";

$deleteQuery = "DELETE FROM kentserv_organizations.orgs_main WHERE org_id = " . $org_id;
$statement = $dbh->prepare($deleteQuery);
$statement->bindParam(':id', $org_id, PDO::PARAM_INT);
$statement->execute();

header("Location: http://kent-serves.greenrivertech.net/partnerstable.php");
?>
