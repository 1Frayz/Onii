<?php

namespace App\Models;

use  App\Application\Database\Model;

class User extends Model
{
    protected string $table = "users";
    protected array $fields = ['email', 'username', 'avatar', 'password', 'token'];
    protected string $email;
    protected string $username;
    protected string $password;
    protected ?string $token;
    protected ?string $avatar;

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function setDefaultAvatar(): void
    {
        $this->avatar = "storage/avatars/no-avatar.jpg";
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }
}
