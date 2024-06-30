<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Profile;
use App\Application\Auth\Auth;
use App\Application\Alerts\Alert;
use App\Application\Helpers\Random;

class UserService implements UserServiceInterface
{
    public function register(array $data): void
    {
        $user = new User();
        $user->setUsername($data["username"]);
        $user->setEmail($data["email"]);
        $user->setPassword($data["password"]);
        $user->setDefaultAvatar();
        $user->store();

        $user = (new User())->find("username", $data["username"]);
        $profile = new Profile();
        $profile->setUserId($user->id());
        $profile->setBio('');
        $profile->setName('');
        $profile->setLinks('');
        $profile->store();
    }

    public function login(string $username, string $password): bool
    {
        $user = (new User())->find('username', $username) ?: (new User())->find('email', $username);
        if (!$user) {
            Alert::storeMessage('User is not found', Alert::DANGER);
            return false;
        }

        if (!password_verify($password, $user->getPassword())) {
            Alert::storeMessage('Incorrect username or password', Alert::DANGER);
            return false;
        }
        $token = Random::str(50);
        $user->update([Auth::getTokenColumn() => $token]);
        setcookie(Auth::getTokenColumn(), $token, time() + 24 * 60 * 60);
        return true;
    }

    public function logout(): void
    {
        unset($_COOKIE[Auth::getTokenColumn()]);
        setcookie(Auth::getTokenColumn(), NULL);
    }
}
