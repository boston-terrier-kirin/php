<?php include 'fn/crud.php'; ?>

<?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        createUser($username, $password);
    }
?>

<?php include 'component/header.php'; ?>

<body>
    <div class="container">
        <div class="col-sm-6">
            <h1>Create</h1>
            <form action="user_create.php" method="post">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="username">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button name="login" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
