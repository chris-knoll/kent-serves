<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/

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
