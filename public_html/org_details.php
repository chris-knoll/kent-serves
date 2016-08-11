<?php
require('./inc/utilities.inc.php');
require_once('./inc/header.php');
require('../db.php');
require('./inc/db_functions/org-main-queries.php');
require('./inc/db_functions/calendar-queries.php');

$org_id = $_GET['id'];
$thisOrganization = getSingleOrganization($org_id);
$thisOrganizationContact = getContactInfo($org_id);
?>



<div class="container mtb org-details-container">

	<div class="col-xs-12 col-sm-8">
		<h3><?php echo $thisOrganization['org_name']; editButton($org_id); ?></h3>
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default detail-panel">
					<div class="panel-heading">
					  <h3 class="detail-panel-heading-dark">Mission</h3>
					</div>

					<div class="detail-panel-body-mission">
					  <?php
						if(empty($thisOrganization['mission'])) {
							echo "No Mission statement found.  Edit your profile and add a Mission Statement!";
						} else {
							echo $thisOrganization['mission'];
						}
						?>
					</div>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-default detail-panel">
					<div class="panel-heading">
					  <h3 class="detail-panel-heading-dark">Area of Service</h3>
					</div>

					<div class="detail-panel-body-service">
						<?php echo "<p class='larger-text'>" . $thisOrganization['service_area'] . "</p>"; ?>
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-default detail-panel">
					<div class="panel-heading">
					  <h3 class="detail-panel-heading-dark">Areas of Need</h3>
					</div>

					<div class="detail-panel-body-need">

							<?php
								foreach (getNeedAreas($org_id) as $need) {
									echo "<p class='org-details-list larger-text'>" . $need . "</p>";
								}
							?>

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<?php addEventButton($org_id); ?>
				<div class="panel panel-default col-xs-12 detail-panel">
					<div class="panel-heading">
					  <h3 class="detail-panel-heading-dark">Upcoming Events</h3>
					</div>

					<div class="detail-panel-body">
						<?php getAndDisplayOrganizationUpcomingEvents($org_id); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<br><br><br>
	<div class="col-xs-12 col-sm-4">
		<div class="col-xs-12">
			<div class="row">
				<h3 class="detail-heading">Contact Information</h3>
				<?php displayContactInfo($org_id); ?>
			</div>
		</div>
	</div>

</div><!-- /container -->

</body>
</html>

<?php require_once('./inc/footer.php'); ?>
