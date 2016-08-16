<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
//require($_SERVER["DOCUMENT_ROOT"] . '/inc/utilities.inc.php');
//require($_SERVER["DOCUMENT_ROOT"] . '/inc/db_functions/org-main-queries.php');
//require($_SERVER["DOCUMENT_ROOT"] . '/inc/org-form-validation.php');

// initialize
$searchServiceArea = "";
$searchOrgNeeds = [];
$searchQuery = "SELECT * FROM kentserv_organizations.orgs_main";

if (isset($_POST['submitSearchOptions'])) {

  $searchServiceArea = $_POST['selectSearchService'];

  if (isset($_POST['searchVolunteers'])) {
    $searchOrgNeeds[] = "volunteer_need";
  }

  if (isset($_POST['searchBoardMem'])) {
    $searchOrgNeeds[] = "board_mem_need";
  }

  if (isset($_POST['searchFunding'])) {
    $searchOrgNeeds[] = "funding_need";
  }

  if (isset($_POST['searchPartnerships'])) {
    $searchOrgNeeds[] = "partnerships_need";
  }

  if (isset($_POST['searchSpace'])) {
    $searchOrgNeeds[] = "space_need";
  }

    if (!empty($searchOrgNeeds) || $searchServiceArea != "Any") {
      $searchQuery .= " WHERE 1=1 ";
      if ($searchServiceArea != "Any") {
        $searchQuery .= "AND service_area='" . $searchServiceArea . "'";
      }
      if (!empty($searchOrgNeeds)) {
        for($i = 0; $i < count($searchOrgNeeds); $i++) {
          if ($i == 0) {
            $searchQuery .= "AND " . $searchOrgNeeds[$i] . "='Y' ";
          } else {
            $searchQuery .= "OR " . $searchOrgNeeds[$i] . "='Y' ";
          }
        }
      }
    }
}

function isSelected($option) {
  if ($searchServiceArea == $option) {
    echo "selected='selected'";
  }
}





?>
