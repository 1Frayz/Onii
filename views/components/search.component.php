<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Follower;
use App\Models\PostTags;
use App\Application\Auth\Auth;

$query = str_replace("/search/", "", $_SERVER['REQUEST_URI']);

$byPost = (new Post())->search($query, 'title');
$byUser = (new User())->search($query, 'username');
$byTag = (new PostTags())->searchPost($query);

?>

<div class="container search mt-4">
    <h2>Search results for: "<?php echo htmlspecialchars($query); ?>"</h2>
    <div class="btn-group mt-3" role="group" aria-label="Search Result Toggle">
        <button type="button" class="btn btn-light active" onclick="showSection('posts')">Posts</button>
        <button type="button" class="btn btn-light" onclick="showSection('users')">Users</button>
        <button type="button" class="btn btn-light" onclick="showSection('tags')">Posts by Tags</button>
    </div>

    <div id="posts" class="mt-4 search-section">
        <div class="row">
            <?php foreach ($byPost as $post) {
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

    <div id="tags" class="mt-4 search-section d-none">
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

    <div id="users" class="mt-4 search-section d-none">
        <?php foreach ($byUser as $user) {
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
                        <p class="card-text">
                            <?php echo $profile->getBio() ? nl2br($profile->getBio()) : 'No bio available'; ?></p>
                        <?php if ($user->id() != Auth::id()) {
                            if ((new Follower())->findByConditions([
                                "user_id" => $user->id(),
                                "follower_id" => Auth::id(),
                            ])) { ?>
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
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="posts">
                    <?php $imageCount = 0;
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
                    <?php $imageCount++;
                    }
                    ?>
                </div>
            </div>
            <hr>
        <?php } ?>
    </div>
</div>