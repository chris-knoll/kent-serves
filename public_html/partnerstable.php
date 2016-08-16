<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
require($_SERVER["DOCUMENT_ROOT"] . '/inc/utilities.inc.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/inc/header.php');
require($_SERVER["DOCUMENT_ROOT"] . '/inc/db_functions/org-main-queries.php');
require($_SERVER["DOCUMENT_ROOT"] . '/inc/search-options-process.php'); // process selected search options
?>

<!-- Data Table Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">





<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


<!-- *****************************************************************************************************************
PARTNERS TABLE
***************************************************************************************************************** -->

<div class="container mtb">
  <div class="row">
    <div class="col-xs-12">
      <div class="optionsDiv" id="optionsDiv">
        <a href="#" class="more"><span class='fa fa-caret-right'></span> More Options</a>
      </div>

      <div class="optionsContent" id="optionsContent">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="row">
            <div class="form-group col-sm-12">
              <div class="row">
                <label for="selectSearchService">Filter area of service:</label>
              </div>
                <select class="ui fluid dropdown" id="selectSearchService" name="selectSearchService">
                  <option value="Any" <?php isSelected("Any"); ?>>Any </option>
                  <option value="Arts" <?php isSelected("Arts"); ?>>Arts </option>
                  <option value="Seniors/Elderly" <?php isSelected("Seniors/Elderly") ?>>Seniors/Elderly</option>
                  <option value="Youth">Youth</option>
                  <option value="Education - Early Childhood">Education - Early Childhood</option>
                  <option value="Education - K-6">Education - K-6</option>
                  <option value="Education - 7-12">Education - 7-12</option>
                  <option value="Homelessness">Homelessness</option>
                  <option value="Immigrant/Refugee">Immigrant/Refugee</option>
                  <option value="Veterans">Veterans</option>
                  <option value="General Community">General Community</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-sm-12">
              <div class="row">
                <label for="selectSearchNeeds">Filter organization needs:</label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="searchVolunteers" value="Volunteers" id="volunteers"
                      <?php if (in_array('volunteer_need', $searchOrgNeeds)) { echo " checked"; } ?>>
                    Volunteers
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="searchBoardMem" value="Board Members" id="boardMembers"
                      <?php if (in_array('board_mem_need', $searchOrgNeeds)) { echo " checked"; } ?>>
                    Board Members
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="searchFunding" value="Funding" id="funding"
                      <?php if (in_array('funding_need', $searchOrgNeeds)) { echo " checked"; } ?>>
                    Funding
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox"  name="searchPartnerships" value="Partnerships / Collaboration" id="partnershipsCollaboration"
                      <?php if (in_array('partnerships_need', $searchOrgNeeds)) { echo " checked"; } ?>>
                    Partnerships / Collaboration
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="searchSpace" value="Meeting Space" id="meetingSpace"
                      <?php if (in_array('space_need', $searchOrgNeeds)) { echo " checked"; } ?>>
                    Meeting Space
                </label>
              </div>

              <button name="submitSearchOptions" type="submit" class="btn btn-primary">Update Results</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="row" id="partnersDiv">
    <div class="col-xs-12">
      <table class="table" id="partnersTable" cellpadding="1" cellspacing="1">
        <thead class="thead-default">
          <tr>
            <th class="orgNameCol">Organization</th>
            <th class="contactCol">Contact Name</th>
            <th class="emailCol">Email</th>
            <!--<th class="adminTableView">Actions</th> Visible in admin view only -->
          </tr>
        </thead>
        <tbody>
          <?php
          buildPartnersTable($searchQuery);
          ?>
        </tbody>

      </table>
    </div>
  </div><!-- /row -->
</div><!-- /container -->

<script>
$('#partnersTable').DataTable();
</script>

<!-- Expand/Collapse Div Script -->
<script>

$(".optionsDiv").click(function() {
  $options = $(this);
  $content = $options.next();
  // toggle view of inner content
  $content.slideToggle(300, function() {
    $options.text(function() {
      // change caret direction
      if ($content.is(":visible")) {
        document.getElementById('optionsDiv').innerHTML = "<a href='#' class='more'><span class='fa fa-caret-down'></span> More Options</a>";
      }
      else {
        document.getElementById('optionsDiv').innerHTML = "<a href='#' class='more'><span class='fa fa-caret-right'></span> More Options</a>";
      }
    });
  });
});

</script>


<?php require_once('./inc/footer.php'); ?>
