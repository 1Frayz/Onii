<?php

namespace App\Controllers;

use App\Application\Views\View;
use App\Application\Config\Config;

class PagesController
{
    public function index(): void
    {
        View::show(
            "pages/index",
            [
                "title" => "Home" . Config::get('app.name'),
            ]
        );
    }

    public function login(): void
    {
        View::show(
            "pages/login",
            [
                "title" => "Login" . Config::get("app.name"),
            ]
        );
    }

    public function register(): void
    {
        View::show(
            "pages/register",
            [
                "title" => "Register" . Config::get("app.name"),
            ]
        );
    }
    public function profile(): void
    {

        View::show(
            "pages/profile",
            [
                "title" => "Profile" . Config::get("app.name"),
            ]
        );
    }
    public function post(): void
    {
        View::show(
            "pages/post",
            [
                "title" => "Post" . Config::get("app.name"),
            ]
        );
    }
    public function settings(): void
    {
        View::show(
            "pages/settings",
            [
                "title" => "Settings" . Config::get("app.name"),
            ]
        );
    }
    public function following(): void
    {
        View::show(
            "pages/following",
            [
                "title" => "Following" . Config::get("app.name"),
            ]
        );
    }

    public function followers(): void
    {
        View::show(
            "pages/followers",
            [
                "title" => "Followers" . Config::get("app.name"),
            ]
        );
    }

    public function detail(): void
    {
        View::show(
            "pages/post.detail",
            [
                "title" => "Detail" . Config::get("app.name"),
            ]
        );
    }
    public function newest(): void
    {
        View::show(
            "pages/newest",
            [
                "title" => "Newest" . Config::get("app.name"),
            ]
        );
    }
    public function search(): void
    {
        View::show(
            "pages/search",
            [
                "title" => "Search" . Config::get("app.name"),
            ]
        );
    }

    public function selection(): void
    {
        View::show(
            "pages/selection",
            [
                "title" => "Selection" . Config::get("app.name"),
            ]
        );
    }
}
