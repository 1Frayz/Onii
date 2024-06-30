<?php

use App\Application\Alerts\Error;
use App\Application\Alerts\Alert;

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="card-title">Create New Post</h3>
                </div>
                <?php

                if (Alert::danger()) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo Alert::danger(true) ?>
                </div>
                <?php
                }

                ?>
                <div class="card-body">
                    <form action="/post/publish" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-4">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags"
                                placeholder="Enter tags separated by space">
                        </div>
                        <div class="form-group mb-4">
                            <label for="image">Upload Image</label>
                            <input type="file"
                                class="form-control-file <?php echo Error::has('image') ? 'is-invalid' : '' ?>"
                                id="image" name="image" required>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php echo Error::get('image') ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>