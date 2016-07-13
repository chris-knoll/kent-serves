
<?php
require_once('./inc/header.php');
require('./inc/registration-form-process.php');
?>


<!-- *****************************************************************************************************************
BLUE WRAP
***************************************************************************************************************** -->
<div id="blue">
	<div class="container">
		<div class="row">
			<h3>Registration Form</h3>
		</div><!-- /row -->
	</div> <!-- /container -->
</div><!-- /blue -->


<!-- *****************************************************************************************************************
CONTACT FORMS
***************************************************************************************************************** -->


<div class="container mtb">
	<div class="row">
		<div class="col-xs-0 col-lg-2"></div><!-- spacer to center form -->
		<div class="col-lg-8">
			<div class="row">
				<h2>Register Your Organization</h2>
				<div class="hline"></div>
				<p><?php echo $result; ?></p>
				<p>Enter your organization and contact information below to be added to our Partners list.</p>
			</div>
			<form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<br/>

				<!-- ORGANIZATION FORM INPUT -->
				<div class="row">
					<h4>Organization Information</h4>
					<div class="hline"></div>
					<div class="form-group col-sm-6">
						<label for="inputOrganization">Organization Name*</label>
						<input type="text" name="inputOrganization" class="form-control" id="organizationName" value="<?php echo $orgName; ?>">
						<?php if($orgNameIsInvalid) printNameError(); ?>
					</div>
					<div class="form-group col-sm-6">
						<label for="inputPhone">Organization Phone Number*</label>
						<input type="text" name="inputPhone" class="form-control" id="organizationPhone" value="<?php echo $orgPhone; ?>">
						<?php if($orgPhoneIsInvalid) printPhoneError(); ?>
					</div>

					<div class="form-group col-sm-12">
						<label for="inputAddress">Address*</label>
						<input type="text" name="inputAddress" class="form-control" id="organizationAddress" value="<?php echo $address; ?>">
						<?php if($orgAddressIsInvalid) printAddressError(); ?>
					</div>

					<div class="form-group col-sm-6">
						<label for="inputWebsite">Website</label>
						<input type="url" name="inputWebsite" class="form-control" id="organizationWebsite" placeholder="Optional">
					</div>
					<div class="form-group col-sm-6">
						<label for="inputFacebook">Facebook</label>
						<input type="url" name="inputFacebook" class="form-control" id="organizationFacebook" placeholder="Optional">
					</div>

					<div class="form-group col-sm-12">
						<label for="selectService">Select area of service</label>
						<select class="form-control" id="selectService">
							<option>Arts </option>
							<option>Seniors/Elderly</option>
							<option>Youth</option>
							<option>Education - Early Childhood</option>
							<option>Education - K-6</option>
							<option>Education - 7-12</option>
							<option>Homelessness</option>
							<option>Immigrant/Refugee</option>
							<option>Veterans</option>
							<option>General Community</option>
						</select>
					</div>
				</div>
				<!-- END ORGANIZATION FORM INPUT -->

				<br/><br/>

				<!-- MAIN CONTACT INPUT -->
				<div class="row">
					<h4>Main Contact Information</h4>
					<div class="hline"></div>
					<div class="form-group col-sm-6 col-md-4">
						<label for="inputMainContact">Main Contact Name*</label>
						<input type="text" name="inputMainContact" class="form-control" id="mainContact"  value="<?php echo $mainContact; ?>">
						<?php if($mainContactNameIsInvalid) printNameError(); ?>
					</div>
					<div class="form-group col-sm-6 col-md-4">
						<label for="inputMainContactEmail">Main Contact Email*</label>
						<input type="email" name="inputMainContactEmail" class="form-control" id="mainContactEmail" value="<?php echo $mainContactEmail; ?>">
						<?php if($mainContactEmailIsInvalid) printEmailError(); ?>
					</div>
					<div class="form-group col-sm-6 col-md-4">
						<label for="inputMainContactPhone">Main Contact Phone*</label>
						<input type="text" name="inputMainContactPhone" class="form-control" id="mainContactPhone" value="<?php echo $mainContactPhone; ?>">
						<?php if($mainContactPhoneIsInvalid) printPhoneError(); ?>
					</div>
				</div>
				<!-- END MAIN CONTACT INPUT -->

				<br/><br/>

				<!-- ALTERNATIVE CONTACT INPUT -->
				<div class="row">
					<h4>Alternative Contact Information (Optional)</h4>
					<div class="hline"></div>
					<div class="form-group col-sm-6 col-md-4">
						<label for="inputAlternativeContact">Alternative Contact Name</label>
						<input type="text" name="inputAlternativeContact" class="form-control" id="AlternativeContact"placeholder="Optional">
						<?php if($alternativeContactNameIsInvalid) printNameError(); ?>
					</div>
					<div class="form-group col-sm-6 col-md-4">
						<label for="inputAlternativeContactEmail">Alternative Contact Email</label>
						<input type="text" name="inputAlternativeContactPhone" class="form-control" id="alternativeContactEmail" placeholder="Optional" value="<?php echo $mainContactPhone; ?>">
						<?php if($alternativeContactEmailIsInvalid) printEmailError(); ?>
					</div>
					<div class="form-group col-sm-6 col-md-4">
						<label for="inputAlternativeContactPhone">Alternative Contact Phone</label>
						<input type="text" name="inputAlternativeContactPhone" class="form-control" id="AlternativeContactPhone" placeholder="Optional">
						<?php if($alternativeContactPhoneIsInvalid) printPhoneError(); ?>
					</div>
				</div>
				<!-- END ALTERNATIVE CONTACT INPUT -->

				<br/>
				<div class="col-xs-12 text-center">
					<button name="submit" type="submit" class="btn btn-primary">Register</button>
				</div>
			</form>  <br />
		</div><!-- /col-lg-8 -->
	</div><!-- /row -->
</div><!-- /container -->

<?php require_once('./inc/footer.php');
