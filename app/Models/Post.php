<?php

namespace App\Models;

use App\Application\Database\Model;

class Post extends Model
{
    protected string $table = "posts";
    protected array $fields = ["image", "title", "user_id"];

    protected string $title;
    protected string $image;
    protected ?int $user_id;

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setUser(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImage(): string
    {
        return $this->image;
    }


    public function getUser(): ?int
    {
        return $this->user_id;
    }
}
