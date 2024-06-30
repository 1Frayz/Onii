<?php

use App\Models\Post;
use App\Models\PostTags;
use App\Models\User;

$posts = (new Post())->all();
$popularTags = (new PostTags())->getPopularTags(6);
?>
<div class="container mt-4">
    <h2>Popular Tags</h2>
    <div class="row tag">
        <?php foreach ($popularTags as $tagData) { ?>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-2">
                <div class="card">
                    <div class="card-body position-relative">
                        <?php if ($tagData['latest_post']) { ?>
                            <a href="/selection/<?php echo htmlspecialchars($tagData['tag']->getTitle()); ?>" class="d-block">
                                <img src="/<?php echo $tagData['latest_post']->getImage(); ?>" class="card-img-top tag-image" alt="Latest Post Image">
                                <h5 class="card-title position-absolute tag-title">
                                    <?php echo htmlspecialchars($tagData['tag']->getTitle()); ?>
                                </h5>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <hr>

    <h2>Latest Posts</h2>
    <div class="row">
        <?php foreach ($posts as $post) {
            $user = (new User())->find('id', $post->getUser());
        ?>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="card">
                    <div class="card-img-container">
                        <a href="/post/<?php echo $post->id(); ?>">
                            <img src="/<?php echo $post->getImage(); ?>" class="card-img-top" alt="Post Image">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($post->getTitle()); ?></h5>
                        <div class="card-profile">
                            <img src="/<?php echo $user->getAvatar(); ?>" class="card-avatar" alt="User Avatar">
                            <a href="/profile/<?php echo $user->getUsername(); ?>">
                                <p class="card-user">
                                    <?php echo htmlspecialchars($user->getUsername()); ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>