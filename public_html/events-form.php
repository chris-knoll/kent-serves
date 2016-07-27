<?php
require_once('./inc/header.php');
//require('./inc/registration-form-process.php');
?>


<div id="blue">
  <div class="container">
    <div class="row">
      <h3>Events</h3>
    </div><!-- /row -->
  </div> <!-- /container -->
</div><!-- /blue -->


<!-- *****************************************************************************************************************
EVENTS  FORMS
***************************************************************************************************************** -->


<div class="container mtb">
  <div class="row">
    <div class="col-xs-0 col-lg-2"></div><!-- spacer to center form -->
    <div class="col-lg-8">
      <div class="row">
        <h2>Create and Post Events</h2>
        <div class="hline"></div>
        <p><?php echo $result; ?></p>

      <br/><br/>
      </div>
      <form role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

        <!-- EVENTS  INPUT -->
        <div class="row">
          <div class="form-group col-sm-6 col-md-4">
            <label for="inputMainContact">Date*</label>
            <input type="text" name="inputMainContact" class="form-control" id="mainContact"  placeholder="DD/MM/YYYY"value="<?php echo $mainContact; ?>">
            <?php if($mainContactNameIsInvalid) printNameError(); ?>
          </div>
          <div class="form-group col-sm-6 col-md-4">
            <label for="inputMainContactEmail">Title*</label>
            <input type="email" name="inputMainContactEmail" class="form-control" id="mainContactEmail" value="<?php echo $mainContactEmail; ?>">
            <?php if($mainContactEmailIsInvalid) printEmailError(); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEvents">Description*</label>
          <textarea class="form-control" rows="5" name="inputEvents" id="description"></textarea>
        </div>
        <!-- END EVENTS  INPUT -->

        <br/><br/>

        <div class="col-xs-12 text-center">
          <button name="submit" type="submit" class="btn btn-primary">submit</button>
        </div>
      </form>  <br />
    </div><!-- /col-lg-8 -->
  </div><!-- /row -->
</div><!-- /container -->
