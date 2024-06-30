<?php

namespace App\Services\Profile;

use App\Models\User;
use App\Models\Profile;
use App\Application\Auth\Auth;
use App\Application\Upload\Upload;


class ProfileService implements ProfileServiceInterface
{
    public function update(string $name, string $bio, string $links): void
    {
        $data = [
            "name" => $name,
            "bio" => $bio,
            "links" => $links,
        ];
        $profile = (new Profile())->find("user_id", Auth::id());
        $profile->update($data);
    }

    public function updateAvatar(array $image): void
    {
        if ($data = ["avatar" => Upload::file($image, 'avatars')]) {
            $user = (new User())->find("id", Auth::id());
            $user->update($data);
        }
    }
}
