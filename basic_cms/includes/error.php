<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
    <?php foreach($errors as $error): ?>
        <p class="mb-0"><?= $error ?></p>
    <?php endforeach ?>
    </div>
<?php endif ?>