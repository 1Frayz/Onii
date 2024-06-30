<?php

namespace App\Models;

use App\Application\Database\Model;

class Tag extends Model
{
    protected string $table = "tags";
    protected array $fields = ["title"];
    protected ?string $title;
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function gettitle(): ?string
    {
        return $this->title;
    }
}