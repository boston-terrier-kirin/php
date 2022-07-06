<?php require APPROOT . "/views/inc/header.php"; ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php showMessage("register_success") ?>
                <h2>Login</h2>
                <p>Please fill in your credentials to log in</p>
                <form action="<?= URLROOT?>/users/login" method="post">
                    <div class="form-group mb-2">
                        <label class="form-label" for="email">Email: <sup>*</sup></label>
                        <input class="form-control <?= !empty($data["email_err"]) ? "is-invalid" : "" ?>" type="email" name="email" id="email" value="<?= $data['email'] ?>"/>
                        <span class="invalid-feedback"><?= $data["email_err"] ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Password: <sup>*</sup></label>
                        <input class="form-control <?= !empty($data["password_err"]) ? "is-invalid" : "" ?>" type="password" name="password" id="password" value="<?= $data['password'] ?>"/>
                        <span class="invalid-feedback"><?= $data["password_err"] ?></span>
                    </div>
                    <div class="row">
                        <div class="d-grid col-6 mx-auto">
                            <button name="login" class="btn btn-success">Login</button>
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <a href="<?= URLROOT ?>/users/register" name="register" class="btn btn-secondary">No account? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require APPROOT . "/views/inc/footer.php"; ?>