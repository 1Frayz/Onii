<?php

namespace App\Models;

use App\Application\Database\Model;

class Follower extends Model
{
    protected string $table = "followers";
    protected array $fields = ["user_id", "follower_id"];
    protected ?int $user_id;
    protected ?int $follower_id;

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setFollower(int $follower_id): void
    {
        $this->follower_id = $follower_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getFollower(): int
    {
        return $this->follower_id;
    }
}
