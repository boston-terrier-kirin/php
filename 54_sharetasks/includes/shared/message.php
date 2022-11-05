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
    <div class="position-fixed top-0 start-50 p-2 opacity-25" style="z-index: 5">
        <div id="success-msg" class="alert alert-success p-2">
            <?php foreach($globalSuccess as $success): ?>
                <p class="mb-0"><i class="bi bi-info-circle-fill"></i> <?= $success ?></p>
            <?php endforeach ?>
        </div>
    </div>
<?php
        unset($_SESSION["SUCCESS_MESSAGE"]);
    }
?>