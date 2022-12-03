<?php
require_once("../bootstrap.php");
http_response_code(500);
?>

<?php require_once APPROOT . "/includes/shared/header.php"; ?>

<div class="container">
  <div class="row">
    <div class="col text-center">
      <div class="display-1">500</div>
      <div class="mb-4 lead">
        Please contact your system administrator.
      </div>
      <a class="btn btn-link" href="<?= URLROOT ?>/task/home">Back to Home</a>
    </div>
  </div>
</div>

<?php require_once APPROOT . "/includes/shared/footer.php"; ?>