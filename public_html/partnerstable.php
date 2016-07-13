<!-- scripts -->
<script src='assets/js/org-table-events.js'></script>

<?php
require_once('./inc/header.php');
require('../db.php');
require('inc/db_functions/org-main-queries.php');
?>


<!-- *****************************************************************************************************************
BLUE WRAP
***************************************************************************************************************** -->
<div id="blue">
	<div class="container">
		<div class="row">
			<h3>Our Partners</h3>
		</div><!-- /row -->
	</div> <!-- /container -->
</div><!-- /blue -->



<!-- *****************************************************************************************************************
PARTNERS TABLE
***************************************************************************************************************** -->

<div class="container mtb">
	<p class="pull-right adminFeature">Change View:&nbsp;&nbsp;
		<a onclick="disableAdminView()">Public</a> |
		<a onclick="enableAdminView()">Admin</a>
	</p>

	<?php $allOrganizations = selectAllOrganizations(); ?>

	<div class="row">
		<div class="col-xs-12">
			<table class="table">
				<thead class="thead-default">
					<tr>
						<th class="orgNameCol">Organization</th>
						<th class="contactCol">Contact Name</th>
						<th class="emailCol">Email</th>
						<th class="adminTableView">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// Display a row for each organization registered.
					foreach($allOrganizations as $row) {
						echo "<tr>";
						echo "<td class='orgNameCol'>" . $row['org_name'] . "</td>";
						echo "<td class='contactCol'>" . $row['main_contact_name'] . "</td>";
						echo "<td class='emailCol'>" . $row['main_contact_email'] . "</td>";
						echo "<td class='adminTableView'>";
						echo "<a class='deleteOrganization' href='/inc/db_functions/delete-organization.php?rowId=" . $row['org_id'] . "'>Delete</a></td>";
						echo "<tr>";
					}
					?>
				</tbody>

			</table>
		</div>
	</div><!-- /row -->
</div><!-- /container -->

<?php require_once('./inc/footer.php');
