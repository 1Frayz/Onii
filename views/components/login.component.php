<?php

use App\Application\Alerts\Alert;
?>

<div class="container-sm">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mt-5">Login</h1>
            <form action="/login" method="post" class="mt-4">
                <?php

                if (Alert::success()) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo Alert::success(true) ?>
                </div>
                <?php
                }
                if (Alert::danger()) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo Alert::danger(true) ?>
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <br>
                <div class="form-group">
                    <p>Don't have an account? <a href="/register">Register</a></p>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>