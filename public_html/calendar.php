<?php
require('./inc/utilities.inc.php');
require_once('./inc/header.php');
require('../db.php');
require_once('./inc/db_functions/calendar-queries.php');
?>

<div class="container mtb">

  <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
    <div class="panel-heading">
      <h3 class="panel-title">
        <?php displayMonthTitle(0); ?>
      </h3>
    </div>
    <div class="panel-body">
      <?php displayOneMonthOfEvents(0); ?>
    </div>
  </div>

  <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
    <div class="panel-heading">
      <h3 class="panel-title">
        <?php displayMonthTitle(1); ?>
      </h3>
    </div>
    <div class="panel-body">
      <?php displayOneMonthOfEvents(1); ?>
    </div>
  </div>

  <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
    <div class="panel-heading">
      <h3 class="panel-title">
        <?php displayMonthTitle(2); ?>
      </h3>
    </div>
    <div class="panel-body">
      <?php displayOneMonthOfEvents(2); ?>
    </div>
  </div>

  <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
    <div class="panel-heading">
      <h3 class="panel-title">
        <?php displayMonthTitle(3); ?>
      </h3>
    </div>
    <div class="panel-body">
      <?php displayOneMonthOfEvents(3); ?>
    </div>
  </div>

  <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
    <div class="panel-heading">
      <h3 class="panel-title">
        <?php displayMonthTitle(4); ?>
      </h3>
    </div>
    <div class="panel-body">
      <?php displayOneMonthOfEvents(4); ?>
    </div>
  </div>

  <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
    <div class="panel-heading">
      <h3 class="panel-title">
        <?php displayMonthTitle(5); ?>
      </h3>
    </div>
    <div class="panel-body">
      <?php displayOneMonthOfEvents(5); ?>
    </div>
  </div>

</div><!-- /container -->


<?php require_once('./inc/footer.php');
