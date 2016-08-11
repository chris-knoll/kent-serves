<?php
// Need to check if utilities already included or else could get an error.
if (!function_exists('class_loader')) {
	require($_SERVER["DOCUMENT_ROOT"] . '/inc/utilities.inc.php');
}

// If no user is logged in, redirect to the login page
if(!$user) {
	header("Location: login.php?");
}

require($_SERVER["DOCUMENT_ROOT"] . '/inc/header.php');
?>

<!---jquery for datepicker--->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<script>
$( function() {
	$( "#datepicker" ).datepicker();
} );
</script>

<!--- end ---->



<!-- *****************************************************************************************************************
EVENTS  FORMS
***************************************************************************************************************** -->


<div class="container mtb">
	<div class="rborder"
	<div class="row">
		<div class="col-xs-0 col-lg-2"></div><!-- spacer to center form -->
		<div class="col-lg-8">
			<div class="row">
				<h2>Create and Post Events</h2>
				<div class="hline"></div>
				<p><?php echo $result; ?></p>

				<br/><br/>
			</div>
			<form role="form" method="post" action="<?php echo $_SERVER["URI"] . '/inc/events-form-process.php'; ?>">



				<div class="row">
					<div class="form-group col-sm-6">
						<div class="row">
							<label for="inputEventTitle">Title </label>
						</div>
						<div class="row">
							<input type="text" class="form-control"  name="inputEventTitle" id="eventTitle" />
							<?php if($eventTitleIsInvalid) printTitleError(); ?>
						</div>
						
						

					</div>
					<div class="form-group col-sm-6">
						<div class="row" id="testDiv">
							<label for="inputLocation">Location </label>
						</div>
						<div class="row" id="eventTitleDiv">
							<input type="text" class="form-control"  name="inputEventLocation" id="eventLocation" />
							<?php if($eventLocationIsInvalid) printLocationError(); ?>
						</div>
						
						
					</div>
				</div>

				<div class="row">
					<div class="form-group  col-sm-6" >
						<div class="row">
							<label for="from">Date:</label>
							<input type="text" class="form-control" name="inputdate" id="datepicker" placeholder="Event Date">
							<?php if($eventDateIsInvalid) printDateError(); ?>
						</div>
					</div>
				</div>

				<div class="row">
					<label for="inputEvents">Description</label>
					<textarea class="form-control" rows="5" name="inputEventDescription" id="description"></textarea>
					<?php if($eventDescriptionIsInvalid) printEventDescriptionError(); ?>
				</div>
				<!-- END EVENTS  INPUT -->

				<br/><br/>

				<div class="col-xs-12 text-center">
					<button name="submit" type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>  <br />
		</div><!-- /col-lg-8 -->
	</div><!-- /row -->
</div><!-- /rborder -->
</div><!-- /container -->
