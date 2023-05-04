<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use \Exception;
use Carbon\Carbon;

use App\Http\Services\CommentService;

class CommentController extends Controller
{

    public function __construct(private CommentService $commentService)
    {
    }

    public function setComment($postId, Request $request)
    {
        $commentData = $request->input("commentData");
        $parentCommentId = $commentData['parentCommentId'];
        $comment = $commentData['comment'];
        $userId = $commentData['userId'];

        return $this->commentService->setComment($parentCommentId, $comment, $userId, $postId);
    }

    public function editComment(Request $request, $commentId)
    {
        $newComment = $request->input('comment');
        return $this->commentService->editComment($commentId, $newComment);
    }

    public function deleteComment($commentId)
    {
        return $this->commentService->deleteComment($commentId);
    }
}
