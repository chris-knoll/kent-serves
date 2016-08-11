<?php

// Insert a new event into the database
function insertNewEvent($orgId, $title, $location, $date, $description) {
  global $dbh;

  $insertQuery = "INSERT into kentserv_organizations.events ";
  $insertQuery .= "(org_id, title, location, date, description) ";
  $insertQuery .= "VALUES (:org_id, :title, :location, :date, :description)";

  $statement = $dbh->prepare($insertQuery);
  $statement->bindParam(':org_id', $orgId, PDO::PARAM_STR);
  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':location', $location, PDO::PARAM_STR);
  $statement->bindParam(':date', $date, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->execute();
}

// Returns a single event associated with the given ID
function getSingleEvent($eventId) {
  global $dbh;

  $selectQuery = "SELECT * FROM kentserv_organizations.events WHERE event_id=" . $eventId . " LIMIT 1;";
  $statement = $dbh->prepare($selectQuery);
  $statement->execute();
  $result = $statement->fetch();

  return $result;
}

// Return events for a single month - given in format YYYY-MM
function selectEventsByMonth($yearAndMonth) {
  global $dbh;

  $selectQuery  = "SELECT orgs.org_name, events.org_id, events.event_id, events.date, events.title ";
  $selectQuery .= "FROM kentserv_organizations.events AS events, kentserv_organizations.orgs_main AS orgs ";
  $selectQuery .= "WHERE events.org_id = orgs.org_id AND date LIKE '" . $yearAndMonth . "%' ";
  $selectQuery .= "ORDER BY date";

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

// Pass 0 for current month, 1 for next month... etc
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
    $orgName = htmlentities($row['org_name']);

    echo "<div class='calendarEventRow'>";
    	echo "<span class='calendarEventDay'>" . substr($date, -2) . "</span>";
      // Holidays don't need to have a link, orgId 0 for holidays
      echo "<span class='calendarEventTitle'>";
      if($orgId != 0) {
        echo "<a href='" . $_SERVER["URI"] . "/event-details.php?eventId=" . $eventId . "'>";
      }
      echo $eventTitle;
      if($orgId != 0) {
        echo "</a>";
         echo " (" . $orgName . ")";
      }
      echo "</span>";

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

// Display all upcoming events for a passed organization ID
function getAndDisplayOrganizationUpcomingEvents($orgId) {
  global $dbh;
  $firstDayOfThisMonth = date('Y-m') . "-01"; // Get the first day of this month
  $selectQuery  = "SELECT events.org_id, events.event_id, events.date, events.title ";
  $selectQuery .= "FROM kentserv_organizations.events AS events ";
  $selectQuery .= "WHERE org_id = " . $orgId . " AND date >= '" . $firstDayOfThisMonth . "' ";
  $selectQuery .= "ORDER BY date";

  $statement = $dbh->prepare($selectQuery);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);

  foreach($result as $row) {
    // Assign results to variables
    $date = htmlentities($row['date']);
    $eventId = htmlentities($row['event_id']);
    $eventTitle = htmlentities($row['title']);
    $orgId = htmlentities($row['org_id']);
    $orgName = htmlentities($row['org_name']);

    echo "<div class='calendarEventRow'>";
      echo "<span class='calendarEventDay'>" . $date . "</span>";
      // Holidays don't need to have a link, orgId 0 for holidays
      echo "<span class='calendarEventTitle'>";
      if($orgId != 0) {
        echo "<a href='" . $_SERVER["URI"] . "/event-details.php?eventId=" . $eventId . "'>";
      }
      echo $eventTitle;
      if($orgId != 0) {
        echo "</a>";
      }
      echo "</span>";

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
