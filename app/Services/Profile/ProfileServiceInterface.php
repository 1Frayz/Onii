<?php

namespace App\Services\Profile;

interface ProfileServiceInterface
{
    public function update(string $name, string $bio, string $links): void;
    public function updateAvatar(array $image): void;
}
