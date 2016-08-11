<?php
require('./inc/utilities.inc.php');
require_once('./inc/header.php');
require('../db.php');
require_once('./inc/db_functions/calendar-queries.php');

if($_GET['startMo']) {
  $startMonth = $_GET['startMo'];
} else {
  $startMonth = 0;
}

if($_GET['totalMos']) {
  $totalMonthsToDisplay = $_GET['totalMos'];
} else {
  $totalMonthsToDisplay = 6;
}
?>

<div class="container mtb">
  <div class="calendarPadding">

    <?php for($i = 0; $i < $totalMonthsToDisplay; $i++) { ?>
      <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
        <div class="panel-heading">
          <h3 class="panel-title">
            <?php displayMonthTitle($startMonth + $i); ?>
          </h3>
        </div>
        <div class="panel-body">
          <?php displayOneMonthOfEvents($startMonth + $i); ?>
        </div>
      </div>
      <?php } // end for loop?>
    </div>
  </div><!-- /container -->


  <?php require_once('./inc/footer.php');
