<?php

namespace App\Controllers;

use App\Application\Alerts\Alert;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\Posts\PostsService;

class PostsController
{
    private PostsService $service;

    public function __construct()
    {
        $this->service = new PostsService();
    }

    public function publish(Request $request)
    {
        $request->validation([
            "title" => ["required"],
            "image" => ["image"],
        ]);

        if ($request->validationStatus()) {
            Alert::storeMessage('Check the fields are correct', Alert::DANGER);
            Redirect::to("/post");
        }

        $this->service->store($request->file("image"), $request->post("title"), $request->post("tags"));
    }
}
