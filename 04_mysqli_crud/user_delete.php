<?php include 'fn/crud.php'; ?>

<?php
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        deleteTable($id);
    }
?>

<?php include 'component/header.php'; ?>

<body>
    <div class="container">
        <h1>Delete</h1>
        <form action="user_delete.php" method="post">
            <div class="form-group mb-3">
                <select class="form-select" name="id">
                    <?php showIds(); ?>
                </select>
            </div>
            <button name="delete" class="btn btn-primary">Delete</button>
        </form>
    </div>
</body>
</html>