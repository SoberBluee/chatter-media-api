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

    public function editComment(Request $request)
    {
        $commentId = $request->input('commentId');
        $newComment = $request->input('comment');
        $postId = $request->input('postId');

        return $this->commentService->editComment($commentId, $newComment, $postId);
    }

    /**
     * Will delete a comment when given a commentId
     *
     * @param Integer $commentId
     * @return JsonResponse
     */
    public function deleteUserComment($commentId)
    {
        try {
            $result = Comment::find($commentId)->delete();
            return ([
                'data' => $result,
                'message' => 'Comment was successfully deleted',
                'status' => 200
            ]);
        } catch (Exception $e) {
            return ([
                'data' => $e,
                'message' => 'Something went wrong deleting your comment',
                'status' => 400,
            ]);
        }
    }
}
