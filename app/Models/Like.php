<?php

namespace App\Models;

use App\Application\Database\Model;

class Like extends Model
{
    protected string $table = "likes";
    protected array $fields = ["user_id", "post_id"];
    protected ?int $user_id;
    protected ?int $post_id;

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getPostId(): int
    {
        return $this->post_id;
    }
}
