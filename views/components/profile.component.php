<?php

use App\Models\User;
use App\Application\Auth\Auth;
use App\Models\Follower;
use App\Models\Profile;

$username = str_replace("/profile/", "", $_SERVER['REQUEST_URI']);
$user = (new User())->find('username', $username);
$profile = (new Profile())->find('user_id', $user->id());

$following = (new Follower())->findByConditions([
    'user_id' => $user->id(),
    'follower_id' => Auth::id(),
]);

$followersCount = (new Follower())->find("user_id", $user->id(), true);
?>

<div class="container mt-4 profile-page">
    <div class="profile">
        <img src="/<?php echo $user->getAvatar() ?>" class="avatar img-fluid rounded-circle" alt="Avatar">
        <div class="profile-username">
            <h5 class="card-title"><?php echo $user->getUsername() ?></h5>
            <a href="/<?php echo $username ?>/followers">
                <p class="card-text"><strong>Followers:</strong><?php echo count($followersCount) ?> </p>
            </a>
            <?php if (Auth::check() && $username === Auth::username()) { ?>
            <a href="/settings" class="btn btn-primary mt-2">Edit profile</a>
            <?php } else { ?>
            <?php if ($following) { ?>
            <form action="/following" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $user->id(); ?>">
                <input type="hidden" name="follower_id" value="<?php echo Auth::id(); ?>">
                <button type="submit" class="btn btn-outline-secondary mt-2">Following</button>
            </form>
            <?php } else { ?>
            <form action="/follow" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $user->id(); ?>">
                <input type="hidden" name="follower_id" value="<?php echo Auth::id(); ?>">
                <button type="submit" class="btn btn-outline-success mt-2">Follow</button>
            </form>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="profile-info">
        <p class="card-text"><strong>Name:</strong>
            <?php echo $profile->getName() ? $profile->getName() : 'No name provided'; ?></p>
        <p class="card-text"><strong>Links:</strong>
            <?php echo $profile->getLinks() ? '<a href="' . $profile->getLinks() . '">' . $profile->getLinks() . '</a>' : 'No links provided'; ?>
        </p>
    </div>
    <div class="profile-bio">
        <p class="card-text"><?php echo $profile->getBio() ? nl2br($profile->getBio()) : 'No bio available'; ?></p>
    </div>
</div>
<hr class="container">