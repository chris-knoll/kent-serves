<?php require('./inc/utilities.inc.php'); ?>
<!-- scripts -->
<script src='assets/js/org-table-events.js'></script>

<?php
require_once('./inc/header.php');
require('../db.php');
require('inc/db_functions/org-main-queries.php');
//require('inc/ui-functions.php');
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
	<!-- Switch between public (default) and admin views -->
	<?php if ($user && $user->isAdmin()): ?>
	<p class="pull-right adminFeature">Change View:&nbsp;&nbsp;
		<a onclick="disableAdminView()">Public</a> |
		<a onclick="enableAdminView()">Admin</a>
	</p>
	<?php endif ?>
	<div class="row">
		<div class="col-xs-12">
			<table class="table">
				<thead class="thead-default">
					<tr>
						<th class="orgNameCol">Organization</th>
						<th class="contactCol">Contact Name</th>
						<th class="emailCol">Email</th>
						<th class="adminTableView">Actions</th> <!-- Visible in admin view only -->
					</tr>
				</thead>
				<tbody>
					<?php
						buildPartnersTable();
					?>
				</tbody>

			</table>
		</div>
	</div><!-- /row -->
</div><!-- /container -->

<?php require_once('./inc/footer.php');
