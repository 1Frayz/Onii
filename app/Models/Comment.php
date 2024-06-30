<?php

namespace App\Models;

use App\Application\Database\Model;

class Comment extends Model
{
    protected string $table = "comments";
    protected array $fields = ["user_id", "post_id", "comment"];
    protected ?int $user_id;
    protected ?int $post_id;
    protected ?string $comment;

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setPostId(int $post_id): void
    {
        $this->post_id = $post_id;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getComments(): string
    {
        return $this->comment;
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