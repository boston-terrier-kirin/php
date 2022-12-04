<?php if (!empty($_SESSION["ERROR_MESSAGE"])) {
    $globalErrors = $_SESSION["ERROR_MESSAGE"];
?>
    <div id="error-msg" class="alert alert-danger p-2">
        <?php foreach($globalErrors as $error): ?>
            <p class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?></p>
        <?php endforeach ?>
    </div>
<?php
        unset($_SESSION["ERROR_MESSAGE"]);
    }
?>

<?php if (!empty($_SESSION["SUCCESS_MESSAGE"])) {
    $globalSuccess = $_SESSION["SUCCESS_MESSAGE"];
?>   
    <div id="success-msg" class="alert d-flex justify-content-between align-items-center p-2">
        <?php foreach($globalSuccess as $success): ?>
            <p class="mb-0"><?= $success ?></p>
        <?php endforeach ?>
        <i id="close-success" class="bi bi-x"></i>
    </div>
<?php
        unset($_SESSION["SUCCESS_MESSAGE"]);
    }
?>