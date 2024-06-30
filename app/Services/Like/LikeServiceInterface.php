<?php

namespace App\Services\Like;

interface LikeServiceInterface
{
    public function like($user_id, $post_id): void;
    public function unlike($user_id, $post_id): void;
}
