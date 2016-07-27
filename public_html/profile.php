<?php require('./inc/utilities.inc.php'); ?>
<?php require_once('./inc/header.php'); ?>

<div class="container">
  <div class="panel panel-default profile">
    <div class="panel-heading">
      <h3 class="panel-title">
        User Profile
      </h3>
    </div>
    <div class="panel-body">
      <?php $user->displayProfile(); ?>
    </div>
  </div>
</div>


<?php require_once('./inc/footer.php'); ?>
