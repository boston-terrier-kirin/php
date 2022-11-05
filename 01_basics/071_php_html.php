<?php
$name = "Kuroro";
$foods = ["Apple", "Banana", "Potate"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- 書き方その１ -->
    <?php if ($name): ?>
        <div>
            <?php echo $name ?>
        </div>
    <?php endif ?>

    <div>
        <?php foreach($foods as $food): ?>
            <?php echo $food ?>
        <?php endforeach ?>
    </div>

    <!-- 書き方その２ -->
    <?php if ($name) { ?>
        <div>
            <?= $name ?>
        </div>
    <?php } ?>

    <div>
        <?php foreach($foods as $food) { ?>
            <?= $food ?>
        <?php } ?>
    </div>
</body>
</html>