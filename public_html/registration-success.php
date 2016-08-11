<?php
require($_SERVER["DOCUMENT_ROOT"] . '/inc/header.php');
?>

<div class="container">
  <div class="panel panel-default profile">
    <div class="panel-heading">
      <h3 class="panel-title">
        Success
      </h3>
    </div>
    <div class="panel-body">
      Thank you for registering!  A confirmation will be sent to <?php echo $mainContactEmail; ?>.</p>
    </div>
  </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"] . '/inc/footer.php'); ?>
