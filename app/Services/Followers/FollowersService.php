<?php

namespace App\Services\Followers;

use App\Models\Follower;

class FollowersService implements FollowersServiceInterface
{
    public function follow($user_id, $follower_id): void
    {
        $follow = new Follower();
        $follow->setFollower($follower_id);
        $follow->setUserId($user_id);
        $follow->store();
    }

    public function following($user_id, $follower_id): void
    {
        $follow = (new Follower())->findByConditions([
            "user_id" => $user_id,
            "follower_id" => $follower_id
        ]);
        $follow->delete();
    }
}
