<?php

namespace App\Services\Posts;

use App\Models\Tag;
use App\Models\Post;
use App\Models\PostTags;
use App\Models\Post_tags;
use App\Application\Auth\Auth;
use App\Application\Alerts\Alert;
use App\Application\Upload\Upload;
use App\Application\Router\Redirect;

class PostsService implements PostsServiceInterface
{
    public function store(array $image, string $title, string $tags = ''): void
    {
        if ($image = Upload::file($image, 'images')) {
            $post = new Post();
            $post->setImage($image);
            $post->setTitle($title);
            $post->setUser(Auth::id());
            $post->store();
            $storedPost = (new Post())->find("image", $image);
            if ($tags) {
                $this->handleTags($storedPost->id(), $tags);
            }
        } else {
            Alert::storeMessage('Error loading', Alert::DANGER);
            Redirect::to('/post');
        }
        Redirect::to('/profile/' . Auth::username());
    }

    private function handleTags(int $postId, string $tags): void
    {
        $tagsArray = explode(' ', $tags);
        foreach ($tagsArray as $titleTag) {
            $tag = (new Tag())->find("title", $titleTag);
            if (!$tag) {
                $tag = new Tag();
                $tag->setTitle($titleTag);
                $tag->store();
                $tag = (new Tag())->find("title", $titleTag);
            }

            $postTag = new PostTags();
            $postTag->setPostId($postId);
            $postTag->setTagId($tag->id());
            $postTag->store();
        }
    }
    public function destroy(int $id): void
    {
        $post = (new Post())->find("id", $id);
        $post->delete();
        Redirect::to('/profile/' . Auth::username());
    }
}
