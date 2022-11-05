<?php
require_once "162_error_page.php";

$currentPage = $_SERVER["PHP_SELF"];

if (isset($_POST["zero_division"])) {
    $i = 1 / 0;
}

if (isset($_POST["invalid_date"])) {
    $datetime = new DateTime("invalid");
}
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
    <div class="container p-3">
        <form action="<?= $currentPage ?>" method="POST">
            <button class="btn btn-danger" name="zero_division">Divide by Zero</button>
            <button class="btn btn-danger" name="invalid_date">Invalid Date</button>
        </form>
    </div>    
</body>
</html>