<?php
    $name = $_COOKIE["name"];
    $email = $_COOKIE["email"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h3>
            <?= $name?>
        </h3>
        <h3>
            <?= $email?>
        </h3>
        <a href="111_cookie.php">Back</a>
        <a href="113_cookie_page3.php">Logout</a>
    </div>
</body>
</html>