<?php

namespace App\Controllers;

use App\Application\Alerts\Alert;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\Comments\CommentsService;

class CommentsController
{
    private CommentsService $service;

    public function __construct()
    {
        $this->service = new CommentsService();
    }

    public function addComment(Request $request)
    {
        $this->service->addComment($request->post("user_id"), $request->post("post_id"), $request->post("comment"));
        Redirect::Referer();
    }

    public function deleteComment(Request $request)
    {
        $this->service->deleteComment($request->post("comment_id"));
        Redirect::Referer();
    }
}