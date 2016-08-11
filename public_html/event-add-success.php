<div class="container">
  <div class="panel panel-default profile">
    <div class="panel-heading">
      <h3 class="panel-title">
        Success
      </h3>
    </div>
    <div class="panel-body">
      Event successfully added!
      <?php echo "<br /><br /><div class='text-center'><a href='" . $_SERVER["URI"] . "/org_details.php?id=" . $user->getOrgId() . "' class='btn btn-primary'>Back To My Organization</a></div>"; ?>
    </div>
  </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/inc/footer.php'); ?>
