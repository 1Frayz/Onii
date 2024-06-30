<?php

use App\Application\Alerts\Alert;
use App\Application\Alerts\Error;
?>

<div class="container-sm">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mt-5">Register</h1>
            <?php

            if (Alert::danger()) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?php echo Alert::danger(true) ?>
            </div>
            <?php
            }

            ?>
            <form action="register" method="post" class="mt-4">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control <?php echo Error::has('username') ? 'is-invalid' : '' ?>"
                        id="username" name="username" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?php echo Error::get('username') ?>
                    </div>

                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control <?php echo Error::has('email') ? 'is-invalid' : '' ?>"
                        id="email" name="email" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?php echo Error::get('email') ?>
                    </div>

                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password:</label>
                    <input type="password" class="form-control <?php echo Error::has('password') ? 'is-invalid' : '' ?>"
                        id="password_confirm" name="password_confirm" required>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?php echo Error::get('password') ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <p>Have an account? <a href="/login">Login</a></p>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
</div>