<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Follower;
use App\Application\Auth\Auth;

$following = (new Follower())->find("follower_id", Auth::id(), true);

?>
<div class="container">
    <h1 class="mb-4">People who follow you</h1>
    <?php foreach ($following as $follower) {
        $user = (new User())->find("id", $follower->getUserId());
        $posts = (new Post())->find('user_id', $user->id(), true);
        $profile = (new Profile())->find('user_id', $user->id());
    ?>
    <div class="following">
        <div class="card-profile">
            <img src="/<?php echo $user->getAvatar(); ?>" class="avatar" alt="...">
            <div class="card-info">
                <a href="/profile/<?php echo $user->getUsername(); ?>">
                    <p class="card-user"><?php echo $user->getUsername(); ?></p>
                </a>
                <p class="card-text"><?php echo $profile->getBio() ? nl2br($profile->getBio()) : 'No bio available'; ?>
                </p>

                <form action="/following" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $user->id(); ?>">
                    <input type="hidden" name="follower_id" value="<?php echo Auth::id(); ?>">
                    <button type="submit" class="btn btn-outline-secondary mt-2">Following</button>
                </form>
            </div>
        </div>
        <div class="posts">
            <?php
                $imageCount = 0;
                foreach ($posts as $post) {
                    if ($imageCount >= 3) {
                        break;
                    }
                ?>
            <div class="post mb-3">
                <a href="/post/<?php echo $post->id(); ?>">
                    <img src="/<?php echo $post->getImage(); ?>" class="post-image" alt="...">
                </a>
            </div>
            <?php
                    $imageCount++;
                }
                ?>
        </div>
    </div>
    <hr>
    <?php } ?>
</div>