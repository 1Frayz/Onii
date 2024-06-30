<?php

namespace App\Services\Posts;

interface PostsServiceInterface
{
    public function store(array $image, string $title, string $tags = ''): void;
    public function destroy(int $id): void;
}
