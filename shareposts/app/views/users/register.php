<?php require APPROOT . "/views/inc/header.php"; ?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2>Create An Account</h2>
                <p>Please fill out this form to register with us</p>
                <form action="<?= URLROOT?>/users/register" method="post">
                    <div class="form-group mb-2">
                        <label class="form-label" for="name">Name: <sup>*</sup></label>
                        <input class="form-control <?= !empty($data["name_err"]) ? "is-invalid" : "" ?>" type="text" name="name" id="name" value="<?= $data['name'] ?>"/>
                        <span class="invalid-feedback"><?= $data["name_err"] ?></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="email">Email: <sup>*</sup></label>
                        <input class="form-control <?= !empty($data["email_err"]) ? "is-invalid" : "" ?>" type="email" name="email" id="email" value="<?= $data['email'] ?>"/>
                        <span class="invalid-feedback"><?= $data["email_err"] ?></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label" for="password">Password: <sup>*</sup></label>
                        <input class="form-control <?= !empty($data["password_err"]) ? "is-invalid" : "" ?>" type="password" name="password" id="password" value="<?= $data['password'] ?>"/>
                        <span class="invalid-feedback"><?= $data["password_err"] ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input class="form-control <?= !empty($data["confirm_password_err"]) ? "is-invalid" : "" ?>" type="password" name="confirm_password" id="confirm_password" value="<?= $data['confirm_password'] ?>"/>
                        <span class="invalid-feedback"><?= $data["confirm_password_err"] ?></span>
                    </div>
                    <div class="row">
                        <div class="d-grid col-6 mx-auto">
                            <button name="register" class="btn btn-success">Register</button>
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <a href="<?= URLROOT ?>/users/login" name="register" class="btn btn-secondary">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require APPROOT . "/views/inc/footer.php"; ?>