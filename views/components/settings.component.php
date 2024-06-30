<?php

use App\Models\Profile;
use App\Application\Auth\Auth;

$profile = (new Profile())->find("user_id", Auth::id());
?>

<div class="container">
    <h1 class="text-center">Profile Settings</h1>
    <form action="/settings" method="post" enctype="multipart/form-data">
        <div class="profile-settings">
            <div class="form-group text-center">
                <label for="avatar" class="d-block">Avatar</label>
                <img src="/<?php echo Auth::avatar() ?>" alt="avatar" class="avatar mb-3">
                <input type="file" name="image" class="form-control-file" id="avatar">
            </div>
            <div class="profile">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="<?php echo $profile->getName() ?>" name="name"
                        id="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea class="form-control id=" bio" name="bio" rows="3"
                        placeholder="Tell us about yourself"><?php echo $profile->getBio() ?></textarea>
                </div>
                <div class="form-group">
                    <label for="links">Links</label>
                    <input type="text" class="form-control" value="<?php echo $profile->getLinks() ?>" name="links"
                        id="links" placeholder="Add your links">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
    </form>
    <hr>
</div>