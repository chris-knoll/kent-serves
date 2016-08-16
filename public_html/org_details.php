<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
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
