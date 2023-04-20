<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use \Exception;

class PostController extends Controller
{
    /**
     * name: getPosts
     * Description: will get a post given an id
     */
    public function getPost(int $user_id)
    {
        try {
            Post::where('id', $user_id)->orderBy('')->get();
        } catch (Exception $e) {
            return ([
                'data' => '',
                'message' => '',
                'status' => '',
            ]);
        }
    }


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
            return ([
                'data' => '',
                'message' => 'Post saved successfully',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return ([
                'data' => $e,
                'message' => 'something went wrong with your upload',
                'status' => 400,
            ]);
        }
    }

    public function deletePost($post_id)
    {
        try {
            // DB::delete('posts')->where('id', $post_id);

            return ([
                'data' => '',
                'message' => '',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return ([
                'data' => '',
                'message' => '',
                'status' => 400,
            ]);
        }
    }

    public function getAllPosts()
    {
        try {
            return ([
                'data' => Post::all(),
                'message' => 'Successfully retrieved data',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return ([
                'data' => '',
                'message' => 'something went wrong with getting yours posts',
                'status' => 400,
            ]);
        }
    }

    public function editPost(Request $request)
    {
        dd("edit");
    }
}
