<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/

require('./inc/utilities.inc.php');
if (!$user || !$user->canEditOrg($_GET['id'])) {
	header("Location: login.php");
}
require('../db.php');
require_once('./inc/header.php');
require('./inc/db_functions/org-main-queries.php');
$org_id = $_GET['id'];
$thisOrganization = getSingleOrganization($org_id);
$thisOrganizationContact = getContactInfo($org_id);
echo "<script type='text/javascript'>alert('test: " . $thisOrganization['orgName'] . ");</script>";
require('./inc/edit-profile-process.php');
?>

<script type="text/javascript" src="checkbox.js"></script>


<!-- *****************************************************************************************************************
CONTACT FORMS
***************************************************************************************************************** -->


<div class="container mtb">
	<div class="row">
		<div class="col-xs-0 col-lg-2"></div><!-- spacer to center form -->
		<div class="col-lg-8">
			<div class="row">
				<h2>Edit Profile</h2>
				<div class="hline"></div>
				<p><?php echo $result; ?>
			</div>
			<form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<br/>

				<!-- ORGANIZATION FORM INPUT -->
				<div class="row">
					<h4>Organization Information</h4>
					<div class="hline"></div>

					<div class="row">
						<div class="form-group col-sm-6">
							<label for="editOrganization">Organization Name*</label>
							<input type="text" name="editOrganization" class="form-control" id="editOrganization" value="<?php echo $orgName; ?>">
							<?php if($orgNameIsInvalid) printNameError(); ?>
						</div>
						<div class="form-group col-sm-6">
							<label for="editPhone">Organization Phone Number*</label>
							<input type="text" name="editPhone" class="form-control" id="editPhone" value="<?php echo $orgPhone; ?>">
							<?php if($orgPhoneIsInvalid) printPhoneError(); ?>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-xs-12">
							<label for="editMission">Mission Statement*</label>
							<textarea name="editMission" class="form-control" id="editMission" rows="4"
							placeholder="What are the goals and values of your organization?"><?php echo $mission; ?></textarea>
							<?php if($orgMissionIsInvalid) printMissionError(); ?>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-12">
							<label for="editAddress">Address*</label>
							<input type="text" name="editAddress" class="form-control" id="editAddress" value="<?php echo $address; ?>">
							<?php if($orgAddressIsInvalid) printAddressError(); ?>
						</div>
					</div>


					<div class="row">
						<div class="form-group col-sm-6">
							<label for="editWebsite">Website</label>
							<input type="url" name="editWebsite" class="form-control" id="editWebsite" placeholder="Optional"
							value="<?php if ($website) { echo $website; } ?>">
						</div>
						<div class="form-group col-sm-6">
							<label for="editFacebook">Facebook</label>
							<input type="url" name="editFacebook" class="form-control" id="editFacebook" placeholder="Optional"
							value="<?php if ($facebook) { echo $facebook; } ?>">
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-12">
							<label for="editSelectService">Select area of service*</label>
							<select class="form-control" id="editSelectService" name="editSelectService">
								<option <?php if ($thisOrganization['service_area'] === 'Arts') { echo "selected='selected'"; } ?>>Arts</option>
								<option	<?php if ($thisOrganization['service_area'] === 'Seniors/Elderly') { echo "selected='selected'"; } ?>>Seniors/Elderly</option>
								<option <?php if ($thisOrganization['service_area'] === 'Youth') { echo "selected='selected'"; } ?>>Youth</option>
								<option <?php if ($thisOrganization['service_area'] === 'Education - Early Childhood') { echo "selected='selected'"; } ?>>Education - Early Childhood</option>
								<option <?php if ($thisOrganization['service_area'] === 'Education - K-6') { echo "selected='selected'"; } ?>>Education - K-6</option>
								<option <?php if ($thisOrganization['service_area'] === 'Education - 7-12') { echo "selected='selected'"; } ?>>Education - 7-12</option>
								<option <?php if ($thisOrganization['service_area'] === 'Homelessness') { echo "selected='selected'"; } ?>>Homelessness</option>
								<option <?php if ($thisOrganization['service_area'] === 'Immigrant/Refugee') { echo "selected='selected'"; } ?>>Immigrant/Refugee</option>
								<option <?php if ($thisOrganization['service_area'] === 'Veterans') { echo "selected='selected'"; } ?>>Veterans</option>
								<option <?php if ($thisOrganization['service_area'] === 'General Community') { echo "selected='selected'"; } ?>>General Community</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-sm-12">
						<label>Select organization needs</label>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="editVolunteerNeed" value="Volunteers" id="volunteers"
								<?php if ($thisOrganization['volunteer_need'] == 'Y') { echo "checked"; } ?>> Volunteers
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="editBoardMemNeed" value="Board Members" id="boardMembers"
								<?php if ($thisOrganization['board_mem_need'] == 'Y') { echo "checked"; } ?>> Board Members
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="editFundingNeed" value="Funding" id="funding"
								<?php if ($thisOrganization['funding_need'] == 'Y') { echo "checked"; } ?>> Funding
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox"  name="editPartnershipsNeed" value="Partnerships / Collaboration" id="partnershipsCollaboration"
								<?php if ($thisOrganization['partnerships_need'] == 'Y') { echo "checked"; } ?>> Partnerships / Collaboration
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="editSpaceNeed" value="Meeting Space" id="meetingSpace"
								<?php if ($thisOrganization['space_need'] == 'Y') { echo "checked"; } ?>> Meeting Space
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="editOtherNeed" value="Other" id="other"
								<?php if ($thisOrganization['other_need'] !== null) { echo "checked"; } ?>> Other
							</label>
						</div>
						<div id="textbox">
							<div class="form-group">
								<label>
									<textarea class="form-control" rows="5" name="editOtherNeedDetails" id="textArea"><?php
									if ($thisOrganization['other_need'] !== null) { echo $thisOrganization['other_need']; } ?></textarea>
								</label>
								</div>
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
								<div class="form-group col-sm-6 col-md-4">
									<label for="editMainContact">Main Contact Name*</label>
									<input type="text" name="editMainContact" class="form-control" id="editMainContact"  value="<?php echo $mainContact; ?>">
									<?php if($mainContactNameIsInvalid) printNameError(); ?>
								</div>
								<div class="form-group col-sm-6 col-md-4">
									<label for="editMainContactEmail">Main Contact Email*</label>
									<input type="email" name="editMainContactEmail" class="form-control" id="editMainContactEmail" value="<?php echo $mainContactEmail; ?>">
									<?php if($mainContactEmailIsInvalid) printEmailError(); ?>
								</div>
								<div class="form-group col-sm-6 col-md-4">
									<label for="editMainContactPhone">Main Contact Phone</label>
									<input type="text" name="editMainContactPhone" class="form-control" id="editMainContactPhone" value="<?php echo $mainContactPhone; ?>" placeholder="Optional">
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
									<div class="form-group col-sm-6 col-md-4">
									<label for="editAlternativeContact">Alternative Contact Name</label>
									<input type="text" name="editAlternativeContact" class="form-control" id="editAlternativeContact" placeholder="Optional"
									value="<?php if ($alternativeContact) { echo $alternativeContact; } ?>">>
									<?php if($alternativeContactNameIsInvalid) printNameError(); ?>
								</div>
								<div class="form-group col-sm-6 col-md-4">
									<label for="editAlternativeContactEmail">Alternative Contact Email</label>
									<input type="text" name="editAlternativeContactPhone" class="form-control" id="editAlternativeContactEmail" placeholder="Optional"
										   value="<?php if ($alternativeContactEmail) { echo $alternativeContactEmail; } ?>">
									<?php if($alternativeContactEmailIsInvalid) printEmailError(); ?>
								</div>
								<div class="form-group col-sm-6 col-md-4">
									<label for="editAlternativeContactPhone">Alternative Contact Phone</label>
									<input type="text" name="editAlternativeContactPhone" class="form-control" id="editAlternativeContactPhone" placeholder="Optional"
									value="<?php if ($alternativeContactPhone) { echo $alternativeContactPhone; } ?>">>
									<?php if($alternativeContactPhoneIsInvalid) printPhoneError(); ?>
								</div>
							</div>

						</div>
						<!-- END ALTERNATIVE CONTACT INPUT -->

						<br/>
						<div class="col-xs-12 text-center">
							<button name="submitChanges" type="submit" class="btn btn-primary">Submit Changes</button>
						</div>
					</form>  <br />
				</div><!-- /col-lg-8 -->
			</div><!-- /row -->
		</div><!-- /container -->

		<?php require_once('./inc/footer.php');
