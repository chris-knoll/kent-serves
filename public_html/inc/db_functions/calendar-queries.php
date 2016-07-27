<?php
try {
  // instantiate a database object
  $dbh = new PDO("mysql:host=localhost; dbname=kentserv_organizations",
  "kentserv_user", "@pple!");
}
catch(PDOException $e) {
  echo $e->getmessage();
}

function selectEventsByMonth($yearAndMonth) {
  global $dbh;

  $selectQuery = "SELECT org_id, event_id, date, title FROM kentserv_organizations.events WHERE date LIKE '" . $yearAndMonth . "%'  ORDER BY date";
  $statement = $dbh->prepare($selectQuery);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

// Get the current year and month
function getYearAndMonth($monthsAheadOfCurrentMonth) {
  if($monthsAheadOfCurrentMonth == 0) {
    return date('Y-m');
  }
  else {
    return date('Y-m', strtotime('+' . $monthsAheadOfCurrentMonth . ' months', strtotime(date('Y-m-d'))));
  }
}

function displayOneMonthOfEvents($monthsAheadOfCurrent) {

  $events = selectEventsByMonth(getYearAndMonth($monthsAheadOfCurrent));

  // Display a row for each organization registered.
  foreach($events as $row) {
    global $user; // So we can access the logged in user
    // Assign results to variables
    $date = htmlentities($row['date']);
    $eventId = htmlentities($row['event_id']);
    $eventTitle = htmlentities($row['title']);
    $orgId = htmlentities($row['org_id']);

  	// Generate a unique URL for each organization
  	$url = "www.google.com";

    echo "<div class='calendarEventRow'>";
    	echo "<span class='calendarEventDay'>" . substr($date, -2) . "</span>";
      // Holidays don't need to have a link, orgId 0 for holidays
      /* UNCOMMENT ONCE WE IMPLEMENT EDIT PAGES FOR EVENTS
      if ($orgId == 0) {
        echo "<span class='calendarEventTitle'>" . $eventTitle . "</span><br />";
      }
      else {
        echo "<span class='calendarEventTitle'><a href='$url'>" . $eventTitle . "</a></span><br />";
      }
      */

      // TEMP NON-LINK EVENTS
      echo "<span class='calendarEventTitle'>" . $eventTitle . "</span>";

      // Check if logged in user can edit the displayed event.
      if($user) {
        if ($user->canEditOrg($orgId)) {
          echo " (Edit)";
        }
      }

      echo "<br />";
    echo "</div>"; // Close the calendarEventRow div
  }
}

function displayMonthTitle($monthsAheadOfCurrentMonth) {
  if($monthsAheadOfCurrentMonth == 0) {
    echo date('F');
  }
  else {
    echo date('F', strtotime('+' . $monthsAheadOfCurrentMonth . ' months', strtotime(date('Y-m-d'))));
  }
}
