<?php include 'fn/crud.php'; ?>

<?php
    $result = getUsers();
?>

<?php include 'component/header.php'; ?>

<body>
    <div class="container">
        <h1>Read</h1>
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $username = $row["username"];
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $id; ?></h5>
                    <p class="card-text"><?php echo $username; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>