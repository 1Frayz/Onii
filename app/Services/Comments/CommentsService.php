<?php

namespace App\Services\Comments;

use App\Models\Comment;

class CommentsService implements CommentsServiceInterface
{
    public function addComment($user_id, $post_id, $text): void
    {
        $comment = new Comment();
        $comment->setPostId($post_id);
        $comment->setUserId($user_id);
        $comment->setComment($text);
        $comment->store();
    }
    public function deleteComment($comment_id): void
    {
        $comment = (new Comment)->find("id", $comment_id);
        $comment->delete();
    }
}