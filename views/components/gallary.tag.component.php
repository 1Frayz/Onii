<?php

use App\Models\User;
use App\Models\PostTags;


$title = str_replace("/selection/", "", $_SERVER['REQUEST_URI']);
$byTag = (new PostTags())->searchPost($title);
?>

<div class="container search mt-4">
    <h1><small class="text-body-secondary">#<?php echo $title ?></small></h1>
    <div id="tags" class="mt-4">
        <div class="row">
            <?php foreach ($byTag as $post) {
                $user = (new User())->find('id', $post->getUser());
            ?>
                <div class="col-lg-3 col-md-6 mb-2">
                    <div class="card">
                        <div class="card-img-container">
                            <a href="/post/<?php echo $post->id() ?>">
                                <img src="/<?php echo $post->getImage() ?>" class="card-img-top" alt="...">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post->getTitle() ?></h5>
                            <div class="card-profile">
                                <img src="/<?php echo $user->getAvatar() ?>" class="card-avatar" alt="...">
                                <a href="/profile/<?php echo $user->getUsername() ?>">
                                    <p class="card-user"><?php echo $user->getUsername() ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>