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
require_once('./inc/db_functions/calendar-queries.php');

if($_GET['startMo']) {
  $startMonth = $_GET['startMo'];
} else {
  $startMonth = 0;
}

if($_GET['totalMos']) {
  $totalMonthsToDisplay = $_GET['totalMos'];
} else {
  $totalMonthsToDisplay = 6;
}
?>

<div class="container mtb">
  <div class="calendarPadding">

    <!-- Buttons to change how many months to show and to go back and forward -->
    <div class="row calendar-options">

      <button id="backOneMonth" class="btn btn-primary pull-left"><< Back</button>


      <label for="monthsToDisplay">Months to Show:</label>
      <select id="monthsToDisplay">
        <?php
        $monthsOptions = array(3, 6, 9, 12);
        foreach($monthsOptions as $option) {
          echo "<option value='" . $option . "'";
          if($totalMonthsToDisplay == $option) {
            echo " selected='selected'";
          }
          echo ">" . $option . "</option>";
        }
        ?>
      </select>

      <button id="forwardOneMonth" class="btn btn-primary pull-right">Forward >> </button>
    </div>

    <!-- Loop to display one or more months of events -->
    <?php for($i = $startMonth; $i < $startMonth + $totalMonthsToDisplay; $i++) { ?>
      <div class="panel panel-default col-md-6 col-lg-4 calendar-month">
        <div class="panel-heading">
          <h3 class="panel-title">
            <?php displayMonthTitle($i); ?>
          </h3>
        </div>
        <div class="panel-body">
          <?php displayOneMonthOfEvents($i); ?>
        </div>
      </div>
      <?php } // end for loop?>
    </div>
  </div><!-- /container -->


  <?php require_once('./inc/footer.php'); ?>

<script>
  // Function to access $_GET variables in javascript
  function $_GET(param) {
  	var vars = {};
  	window.location.href.replace( location.hash, '' ).replace(
  		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
  		function( m, key, value ) { // callback
  			vars[key] = value !== undefined ? value : '';
  		}
  	);

  	if ( param ) {
  		return vars[param] ? vars[param] : null;
  	}
  	return vars;
  }

  $(document).ready(function() {

    $('#monthsToDisplay').change(function() {
      var monthsToDisplay = $(this).find('option:selected').text();
      var startMo = $_GET('startMo');
      var url = "http://kent-serves.greenrivertech.net/calendar.php?";
      if(startMo != null) {
        url += "startMo=" + startMo + "&";
      }
      url += "totalMos=" + monthsToDisplay;
      window.location = url;
    });

    $('#backOneMonth').click(function() {
      var startMo = $_GET('startMo');
      var monthsToDisplay = $_GET('totalMos');
      var url = "http://kent-serves.greenrivertech.net/calendar.php?";
      if(monthsToDisplay != null) {
        url += "totalMos=" + monthsToDisplay + "&";
      }
      if(startMo != null) {
        startMo--;
      } else {
        startMo = -1;
      }
      url += "startMo=" + startMo;
      window.location = url;
    });

    $('#forwardOneMonth').click(function() {
      var startMo = $_GET('startMo');
      var monthsToDisplay = $_GET('totalMos');
      var url = "http://kent-serves.greenrivertech.net/calendar.php?";
      if(monthsToDisplay != null) {
        url += "totalMos=" + monthsToDisplay + "&";
      }
      if(startMo != null) {
        startMo++;
      } else {
        startMo = 1;
      }
      url += "startMo=" + startMo;
      window.location = url;
    });
  });
</script>
