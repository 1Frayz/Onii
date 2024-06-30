<?php

namespace App\Controllers;

use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\Followers\FollowersService;

class FollowersController
{
    private FollowersService $service;

    public function __construct()
    {
        $this->service = new FollowersService();
    }

    public function follow(Request $request)
    {
        $this->service->follow($request->post("user_id"), $request->post("follower_id"));
        Redirect::Referer();
    }

    public function following(Request $request)
    {
        $this->service->following($request->post("user_id"), $request->post("follower_id"));
        Redirect::Referer();
    }
}
