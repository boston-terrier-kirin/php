<?php
require __DIR__ . "/vendor/autoload.php";

if (isset($_POST["register"])) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $database = new Database($_ENV["DB_HOST"], $_ENV["DB_NAME"], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
    $conn = $database->getConnection();

    $sql = "insert into user(name, username, password, api_key)
            values(:name, :username, :password, :api_key)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("name", $_POST["name"], PDO::PARAM_STR);
    $stmt->bindValue("username", $_POST["username"], PDO::PARAM_STR);
    $stmt->bindValue("password", password_hash($_POST["password"], PASSWORD_DEFAULT), PDO::PARAM_STR);

    $api_key = bin2hex(random_bytes(16));
    $stmt->bindValue("api_key", $api_key, PDO::PARAM_STR);
    $stmt->execute();
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
    <div class="container mt-3">       
        <h1>Register</h1>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button class="btn btn-primary" name="register">Register</button>
        </form>
    </div>
</body>
</html>