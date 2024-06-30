<?php

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\PostTags;
use App\Application\Auth\Auth;

$id = str_replace("/post/", "", $_SERVER['REQUEST_URI']);
$post = (new Post())->find('id', $id);
$user = (new User())->find('id', $post->getUser());
$posts = (new Post())->find('user_id', $user->id(), true);
$likes = (new Like())->find('post_id', $post->id(), true);
$comments = (new Comment())->find('post_id', $post->id(), true);

?>

<div class="container mt-4 post-detail">
    <div class="row">
        <div class="col-md-8 post">
            <img src="/<?php echo $post->getImage(); ?>" class="img-fluid post-image" alt="Post Image">
            <div class="post-info">
                <div class="post-bt">
                    <h1 class="post-title"><?php echo $post->getTitle(); ?></h1>
                    <div class="likes-container">
                        <?php if ((new Like())->findByConditions([
                            "user_id" => Auth::id(),
                            "post_id" => $post->id(),
                        ])) { ?>
                            <form action="/unlike" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="post_id" value="<?php echo $post->id(); ?>">
                                <input type="hidden" name="user_id" value="<?php echo Auth::id(); ?>">
                                <button class="btn btn-like">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                </button>
                            </form>
                        <?php } else { ?>
                            <form action="/like" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="post_id" value="<?php echo $post->id(); ?>">
                                <input type="hidden" name="user_id" value="<?php echo Auth::id(); ?>">
                                <button class="btn btn-like">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </form>
                        <?php } ?>
                        <p class="post-likes-count"><?php echo count($likes); ?></p>
                    </div>
                </div>
                <?php
                $tags = (new PostTags())->find("post_id", $post->id(), true);
                $tagLinks = [];
                foreach ($tags as $tag) {
                    $tagTitle = $tag->getTagTitle();
                    $tagLinks[] = '<a class="post-tag" href="/selection/' . urlencode($tagTitle) . '">#' . htmlspecialchars($tagTitle) . '</a>';
                }

                $formattedTags = implode(' ', $tagLinks);
                ?>

                <p class="post-tags"><?php echo $formattedTags; ?></p>

                <p class="post-tags"><?php echo $post->created_at(); ?></p>
            </div>
            <div class="post-comments">
                <h2>Comments</h2>
                <?php if (Auth::check()) { ?>
                    <form action="/add/comment" method="post" enctype="multipart/form-data" class="mb-4 user-info d-flex align-items-start">
                        <img src="/<?php echo Auth::avatar(); ?>" class="card-avatar rounded-circle me-3" alt="...">
                        <input type="hidden" name="post_id" value="<?php echo $post->id(); ?>">
                        <input type="hidden" name="user_id" value="<?php echo Auth::id(); ?>">
                        <div class="flex-grow-1">
                            <div class="mb-3">
                                <textarea name="comment" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>


                <?php
                if ($comments) {
                    foreach ($comments as $comment) {
                        $commentUser = (new User())->find('id', $comment->getUserId());
                ?>
                        <div class="comment mb-3">
                            <div class="d-flex align-items-center">
                                <img src="/<?php echo $commentUser->getAvatar(); ?>" class="comment-avatar rounded-circle mr-3" alt="...">
                                <div class="flex-grow-1">
                                    <a href="/profile/<?php echo $commentUser->getUsername(); ?>" class="text-decoration-none">
                                        <p class="mb-0"><?php echo $commentUser->getUsername(); ?></p>
                                    </a>
                                    <small class="text-muted"><?php echo $comment->created_at(); ?></small>
                                </div>
                                <?php if ($commentUser->getUsername() == Auth::username()) { ?>
                                    <form action="/delete/comment" method="post" class="ms-auto">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment->id(); ?>">
                                        <button type="submit" class="btn btn-link p-0 text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                            </svg>
                                        </button>
                                    </form>
                                <?php } ?>
                            </div>
                            <p class="mt-2"><?php echo htmlspecialchars($comment->getComments()); ?></p>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p>No comments yet. Be the first to comment!</p>
                <?php } ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="user-info">
                <div class="card-profile">
                    <img src="/<?php echo $user->getAvatar(); ?>" class="avatar" alt="...">
                    <div class="card-info">
                        <a href="/profile/<?php echo $user->getUsername(); ?>">
                            <p class="card-user"><?php echo $user->getUsername(); ?></p>
                        </a>
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
        </div>
    </div>
</div>