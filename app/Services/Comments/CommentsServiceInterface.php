<?php

namespace App\Services\Comments;

interface CommentsServiceInterface
{
    public function addComment($user_id, $post_id, $comment): void;
    public function deleteComment($id): void;
}