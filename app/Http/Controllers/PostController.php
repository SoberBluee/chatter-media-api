<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use \Exception;

class PostController extends Controller
{
    /**
     * name: setPost
     * description: will create a new post
     */
    public function setPost(Request $request)
    {
        try {
            $posts = new Post();
            /**
             * need to generate id here
             */
            $posts->title = $request->input('title');
            $posts->img = ''; //$request->input('img');
            $posts->body = $request->input('body');
            $posts->comment_id = 4; //$request->input    ('comment_id'); // need to auto assign number before going to db
            $posts->likes = 0;
            $posts->created_at = Carbon::now();

            $posts->save();

            /**
             * might need to return post data for other stuff
             */
            return response()->json([
                'data' => '',
                'message' => 'Post saved successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Something went wrong with your upload'
            ], 400);
        }
    }

    public function deletePost($post_id)
    {
        try {
            Post::find($post_id)->delete();
            return ([
                'data' => '',
                'message' => '',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return ([
                'data' => $e,
                'message' => '',
                'status' => 400,
            ]);
        }
    }

    public function getAllPosts()
    {
        try {
            return response()->json([
                'data' => Post::with('comments')->get()->toArray(),
                'message' => 'Successfully retrieved data'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => $e,
                'message' => 'Something went wrong with getting your posts'
            ], 400);
        }
    }

    public function editPost(Request $request)
    {
        dd("edit");
    }
}
