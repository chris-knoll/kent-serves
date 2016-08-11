<?php
require('./inc/utilities.inc.php');
require_once('./inc/header.php');
require('../db.php');
require('./inc/db_functions/org-main-queries.php');
require('./inc/db_functions/calendar-queries.php');

$event_id = $_GET['eventId'];
$thisEvent = getSingleEvent($event_id);
?>



<div class="container mtb org-details-container">

	<div class="col-xs-12 col-sm-8">
		<h3><?php echo $thisEvent['title']; ?></h3>
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default detail-panel">
					<div class="panel-heading">
					  <h3 class="detail-panel-heading">Description</h3>
					</div>

					<div class="detail-panel-body">
					  <?php displayEventDescription(); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
<br><br><br>


</div><!-- /container -->

</body>
</html>

<?php require_once('./inc/footer.php');

function displayEventDescription() {
  if ($thisEvent['description'] == "" || !$thisEvent['description']) {
    echo "This is where the description of your event will be displayed.<br /><br />";
    echo "Talk about where the event is located, what time it starts, what will be happening, who should show up, if you are looking for help or volunteers, and any other information you would like the public to see!";
  } else {
    echo $thisEvent['description'];
  }
}
