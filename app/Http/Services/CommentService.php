<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Carbon;

class CommentService
{
    /**
     * @param Integer $commentId
     * @param String $newComment
     * @return JsonResponse
     */
    public function editComment($commentId, $newComment)
    {
        try {
            $commentToEdit = Comment::find($commentId);
            $commentToEdit->comment = $newComment;
            $commentToEdit->modified_at = Carbon::now();
            $commentToEdit->save();
            return response()->json([
                'data' => $commentToEdit,
                'message' => 'Successfully edited your message',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Something went wrong editing your comment',
            ], 400);
        }
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

            return response()->json([
                'data' => $newComment,
                'message' => 'Comment saved successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Something went wrong',
            ], 400);
        }
    }

    /**
     * Will delete a comment when given a commentId
     *
     * @param Integer $commentId
     * @return JsonResponse
     */
    public function deleteComment($commentId)
    {
        try {
            return response()->json([
                'data' => Comment::find($commentId)->delete(),
                'message' => 'Comment was successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Something weng wrong deleting your comment'
            ], 400);
        }
    }
}
