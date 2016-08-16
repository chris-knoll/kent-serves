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
