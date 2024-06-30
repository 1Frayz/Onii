<?php

namespace App\Models;

use App\Application\Database\Model;

class Profile extends Model
{

    protected string $table = "profiles";
    protected array $fields = ['bio', 'links', 'name', "user_id"];
    protected string $name;
    protected string $links;
    protected string $bio;
    protected int $user_id;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setLinks(string $links): void
    {
        $this->links = $links;
    }

    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getLinks(): string
    {
        return $this->links;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}
