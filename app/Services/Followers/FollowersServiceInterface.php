<?php

namespace App\Services\Followers;

interface FollowersServiceInterface
{
    public function follow($user_id, $follower_id): void;
    public function following($user_id, $follower_id): void;
}
