<?php include 'fn/crud.php'; ?>

<?php
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        updateTable($id, $username, $password);
    }
?>

<?php include 'component/header.php'; ?>

<body>
    <div class="container">
        <h1>Update</h1>
        <form action="user_update.php" method="post">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="username">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group mb-3">
                <select class="form-select" name="id">
                    <?php showIds(); ?>
                </select>
            </div>
            <button name="update" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>