<?php

namespace App\Services\Like;

use App\Models\Like;

class LikeService
{
    public function like($user_id, $post_id): void
    {
        $like = new Like();
        $like->setPostId($post_id);
        $like->setUserId($user_id);
        $like->store();
    }

    public function unlike($user_id, $post_id): void
    {
        $like = (new Like())->findByConditions([
            "user_id" => $user_id,
            "post_id" => $post_id
        ]);
        $like->delete();
    }
}
