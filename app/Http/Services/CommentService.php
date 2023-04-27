<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Carbon;

class CommentService
{
    public function editComment($commentId, $newComment, $postId)
    {
    }


    public function setComment($parentCommentId, $comment, $userId, $postId)
    {
        if ($parentCommentId !== null) {
            $parentComment = Comment::find($parentCommentId);
            assert($parentComment, 'Parent comment does not exist');
        }

        try {
            $newComment = new Comment();
            $newComment->parentCommentId = $parentCommentId;
            $newComment->postId = $postId;
            $newComment->userId = $userId;
            $newComment->comment = $comment;
            $newComment->created_at = Carbon::now();
            $newComment->modified_at = Carbon::now();
            $newComment->save();

            return ([
                'data' => $newComment,
                'message' => 'Comment saved successfully',
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            dd($e);
            return ([
                'data' => $e,
                'message' => 'Something went wrong',
                'status' => 400

            ]);
        }
    }
}
