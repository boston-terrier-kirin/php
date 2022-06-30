<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
    <?php foreach($errors as $error): ?>
        <p class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?></p>
    <?php endforeach ?>
    </div>
<?php endif ?>