<?php
if (isset($_POST["submit"])) {
    echo htmlspecialchars($_POST["message"]);
    echo "<br />--------------------<br />";

    echo htmlentities($_POST["message"]);
    echo "<br />--------------------<br />";

    // filter_input_arrayでもエスケープされる。
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    echo $_POST["message"];
    echo "<br />--------------------<br />";
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
        <form action="091_post.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea id="message" name="message" class="form-control"><?= htmlspecialchars("<script>alert('test')</script>") ?></textarea>
            </div>
            <button name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>