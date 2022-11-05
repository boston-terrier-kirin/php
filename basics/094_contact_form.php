<?php
$currentPage = $_SERVER["PHP_SELF"];
$msg = "";
$msgClass = "";
$email = "";
$name = "";
$message = "";

if (filter_has_var(INPUT_POST, "submit")) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if (!empty($email) && !empty($name) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msg = "Please use a valid email";
            $msgClass = "alert-danger";           
        } else {
            $msg = "Your email has been sent";
            $msgClass = "alert-success";
        }
    } else {
        $msg = "Please fill in all fields";
        $msgClass = "alert-danger";
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
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mb-0 h1" href="<?= $currentPage ?>">My Website</a>
        </div>
    </nav>

    <div class="container p-3">
        <?php if($msg != ""): ?>
            <div class="alert <?= $msgClass ?>"><?= $msg ?></div>
        <?php endif ?>

        <form action="<?= $currentPage ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea id="message" name="message" class="form-control"><?= $message ?></textarea>
            </div>
            <button name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>