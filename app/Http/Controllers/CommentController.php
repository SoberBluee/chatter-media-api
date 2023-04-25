<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use \Exception;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    public function setComment($postId, Request $request)
    {
        $parentCommentId = (int) $request->input('parentCommentId');
        $comment = (string)$request->input('comment');
        $userId = (int)$request->input('userId');

        if ($parentCommentId !== 0) {
            $parentComment = Comment::find($parentCommentId);
            assert($parentComment, 'Parent comment does not exist');
        }

        try {
            // dd($parentCommentId, $comment, $userId, $postId);
            // $comment = Comment::create([
            //     'parentCommentId' => $parentCommentId ? $parentCommentId : null,
            //     'postId' => $postId,
            //     "userId" => $userId,
            //     'comment' => $comment,
            //     'created_at' => Carbon::now(),
            //     'modified_at' => Carbon::now(),
            // ]);
            $comment = new Comment();
            $comment->parentCommentId = $parentCommentId;
            $comment->comment = $comment;
            $comment->userId = $userId;
            $comment->created_at = Carbon::now();
            $comment->modified_at = Carbon::now();
            // DB::enableQueryLog();
            $comment->save();
            // dd(DB::getQueryLog());

            return ([
                'data' => $comment,
                'message' => 'Comment saved successfully',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            dd($e);
            return ([
                'data' => $e,
                'message' => 'Something went wrong',
                'status' => 400

            ]);
        }
    }

    public function getUserComments(Request $request)
    {
    }
}
