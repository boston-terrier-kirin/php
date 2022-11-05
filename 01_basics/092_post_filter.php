<?php
// https://www.php.net/manual/ja/filter.filters.sanitize.php
// https://www.php.net/manual/ja/filter.filters.validate.php

// FILTER_SANITIZE_FULL_SPECIAL_CHARS でエスケープすることもできるが、
// 個別に対応することもできる。
// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// <script>alert(1)</script>

if (isset($_POST["submit"])) {
    if (filter_has_var(INPUT_POST, "name")) {
        $name = $_POST["name"];
        $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        echo "name: " . $name;
    }
    echo "<br />";

    if (filter_has_var(INPUT_POST, "message")) {
        // INPUT_POSTを使わないで個別にsanitize。
        // <script> を入力すると、空白 になる。
        $message = $_POST["message"];
        $message = filter_var($message, FILTER_SANITIZE_STRING);
        echo "message: " . $message;
    } else {
        echo "Message not found";
    }
    echo "<br />";

    if (filter_has_var(INPUT_POST, "age")) {
        $age = $_POST["age"];
        if (filter_var($age, FILTER_VALIDATE_INT)) {
            echo "Age is valid";
        } else {
            echo "Age is invalid";
        }
    }
    echo "<br />";

    if (filter_has_var(INPUT_POST, "email")) {
        // INPUT_POSTを使わないで個別にsanitize。
        // <script> を入力すると、script になる。
        $email = $_POST["email"];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        echo "message: " . $email . "<br />";

        // INPUT_POSTを使う
        if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
            echo "Email is valid";
        } else {
            echo "Email is invalid";
        }
    }
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
    <div class="container">
        <form action="092_post_filter.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" >
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" name="age" >
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea id="message" name="message" class="form-control"></textarea>
            </div>
            <button name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>