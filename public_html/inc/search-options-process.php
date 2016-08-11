<?php
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
