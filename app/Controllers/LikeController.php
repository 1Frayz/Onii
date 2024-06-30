<?php

namespace App\Controllers;

use App\Services\Like\LikeService;
use App\Application\Request\Request;
use App\Application\Router\Redirect;

class LikeController
{
    private LikeService $service;

    public function __construct()
    {
        $this->service = new LikeService();
    }

    public function like(Request $request)
    {
        $this->service->like($request->post("user_id"), $request->post("post_id"));
        Redirect::Referer();
    }

    public function unlike(Request $request)
    {
        $this->service->unlike($request->post("user_id"), $request->post("post_id"));
        Redirect::Referer();
    }
}
