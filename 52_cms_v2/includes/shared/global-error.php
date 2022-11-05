<?php if (!empty($globalErrors)): ?>
    <div class="alert alert-danger p-2">
    <?php foreach($globalErrors as $error): ?>
        <p class="mb-0"><i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?></p>
    <?php endforeach ?>
    </div>
<?php endif ?>