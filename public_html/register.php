<?php
/*
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/


// Need to check if utilities already included or else could get an error.
if (!function_exists('class_loader')) {
	require($_SERVER["DOCUMENT_ROOT"] . '/inc/utilities.inc.php');
}
require($_SERVER["DOCUMENT_ROOT"] . '/inc/header.php');
//require($_SERVER["DOCUMENT_ROOT"] . '/inc/registration-form-process.php');
?>

<!-- *****************************************************************************************************************
CONTACT FORMS
***************************************************************************************************************** -->


<div class="container mtb">
	<div class="rborder"
	<div class="row">
		<div class="col-xs-0 col-lg-2"></div><!-- spacer to center form -->
		<div class="col-lg-8">
			<div class="row">
				<h2>Register Your Organization</h2>
				<div class="hline"></div>
				<p><?php echo $result; ?></p>
				<p>Enter your organization and contact information below to be added to our Partners list.</p>
				<?php if(isset($submissionIsValid) && $submissionIsValid == false) printHeaderError(); ?>
			</div>
			<form method="post" action="<?php echo $_SERVER["URI"] . '/inc/registration-form-process.php'; ?>">
				<br/>

				<!-- ORGANIZATION FORM INPUT -->
				<div class="row">
					<h4>Organization Information</h4>
					<div class="hline"></div>

					<div class="row">
						<div class="form-group col-sm-6">
							<label for="inputOrganization">Organization Name*</label>
							<input type="text" name="inputOrganization" class="form-control" id="inputOrganization" value="<?php echo $orgName; ?>">
							<?php if($orgNameIsInvalid) printNameError(); ?>
							<?php if($orgNameAlreadyRegistered) printOrgAlreadyRegisteredError(); ?>
						</div>
						<div class="form-group col-sm-6">
							<label for="inputPhone">Organization Phone Number*</label>
							<input type="text" name="inputPhone" class="form-control" id="inputPhone" value="<?php echo $orgPhone; ?>">
							<?php if($orgPhoneIsInvalid) printPhoneError(); ?>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-xs-12">
							<label for="inputMission">Mission Statement*</label>
							<textarea name="inputMission" class="form-control" id="inputMission" rows="4"
							placeholder="What are the goals and values of your organization?"><?php if ($mission) { echo $mission; } ?></textarea>
							<?php if($orgMissionIsInvalid) printMissionError(); ?>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-12">
							<label for="inputAddress">Address*</label>
							<input type="text" name="inputAddress" class="form-control" id="inputAddress" value="<?php echo $address; ?>">
							<?php if($orgAddressIsInvalid) printAddressError(); ?>
						</div>
					</div>


					<div class="row">
						<div class="form-group col-sm-6">
							<label for="inputWebsite">Website</label>
							<input type="url" name="inputWebsite" class="form-control" id="inputWebsite" placeholder="Optional"
							value="<?php if ($website) { echo $website; } ?>">
						</div>
						<div class="form-group col-sm-6">
							<label for="inputFacebook">Facebook</label>
							<input type="url" name="inputFacebook" class="form-control" id="inputFacebook" placeholder="Optional"
							value="<?php if ($facebook) { echo $facebook; } ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-12">
							<label for="selectService">Select area of service*</label>
							<select class="form-control" id="selectService" name="selectService">
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

					<div class="row">
						<div class="form-group col-sm-12">
							<label for="selectService">Select organization needs</label>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="volunteerNeed" value="Volunteers" id="volunteers"> Volunteers
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="boardMemNeed" value="Board Members" id="boardMembers"> Board Members
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="fundingNeed" value="Funding" id="funding"> Funding
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox"  name="partnershipsNeed" value="Partnerships / Collaboration" id="partnershipsCollaboration"> Partnerships / Collaboration
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="spaceNeed" value="Meeting Space" id="meetingSpace"> Meeting Space
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="otherNeed" value="Other" id="other"> Other
								</label>
							</div>
							<div id="textbox">
								<div class="form-group">
									<label>
										<textarea class="form-control" rows="5" name="otherNeedDetails" id="textArea"></textarea>							</label>
									</div>
								</div>
							</div>
						</div>
						<!-- END ORGANIZATION FORM INPUT -->

						<br/><br/>

						<!-- MAIN CONTACT INPUT -->
						<div class="row">
							<h4>Main Contact Information</h4>
							<div class="hline"></div>


							<div class="row">
								<div class="form-group col-md-4">
									<label for="inputMainContact">Main Contact Name*</label>
									<input type="text" name="inputMainContact" class="form-control" id="inputMainContact"  value="<?php echo $mainContact; ?>">
									<?php if($mainContactNameIsInvalid) printNameError(); ?>
								</div>
								<div class="form-group col-md-4">
									<label for="inputMainContactEmail">Main Contact Email*</label>
									<input type="email" name="inputMainContactEmail" class="form-control" id="inputMainContactEmail" value="<?php echo $mainContactEmail; ?>">
									<?php if($mainContactEmailIsInvalid) printEmailError(); ?>
									<?php if($accountExistsForGivenEmail) printAccountExistsForEmailError(); ?>
								</div>
								<div class="form-group col-md-4">
									<label for="inputMainContactPhone">Main Contact Phone</label>
									<input type="text" name="inputMainContactPhone" class="form-control" id="inputMainContactPhone" value="<?php echo $mainContactPhone; ?>" placeholder="Optional">
									<?php if($mainContactPhoneIsInvalid) printPhoneError(); ?>
								</div>
							</div>
						</div>
						<!-- END MAIN CONTACT INPUT -->

						<br/><br/>

						<!-- ALTERNATIVE CONTACT INPUT -->
						<div class="row">
							<h4>Alternative Contact Information (Optional)</h4>
							<div class="hline"></div>

							<div class="row">
								<div class="form-group col-md-4">
									<label for="inputAlternativeContact">Alternative Contact Name</label>
									<input type="text" name="inputAlternativeContact" class="form-control" id="inputAlternativeContact" placeholder="Optional"
									value="<?php if ($alternativeContact) { echo $alternativeContact; } ?>">
									<?php if($alternativeContactNameIsInvalid) printNameError(); ?>
								</div>
								<div class="form-group col-md-4">
									<label for="inputAlternativeContactEmail">Alternative Contact Email</label>
									<input type="text" name="inputAlternativeContactPhone" class="form-control" id="inputAlternativeContactEmail" placeholder="Optional"
									value="<?php if ($alternativeContactEmail) { echo $alternativeContactEmail; } ?>">
									<?php if($alternativeContactEmailIsInvalid) printEmailError(); ?>
								</div>
								<div class="form-group col-md-4">
									<label for="inputAlternativeContactPhone">Alternative Contact Phone</label>
									<input type="text" name="inputAlternativeContactPhone" class="form-control" id="inputAlternativeContactPhone" placeholder="Optional"
									value="<?php if ($alternativeContactPhone) { echo $alternativeContactPhone; } ?>">
									<?php if($alternativeContactPhoneIsInvalid) printPhoneError(); ?>
								</div>
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
		</div>
	</div><!-- /container -->

<script>
	function preparePage() {
	document.getElementById("other").onclick = function() {
	if (document.getElementById("other").checked) {
	  // use CSS style to show it
	  document.getElementById("textbox").style.display = "block";
	} else {
	  // hide the div
	  document.getElementById("textbox").style.display = "none";
	}
	};
	// now hide it on the initial page load.
	document.getElementById("textbox").style.display = "none";
	}

	window.onload =  function() {
	preparePage();
	};
</script>


	<?php require_once($_SERVER["DOCUMENT_ROOT"] . '/inc/footer.php');
