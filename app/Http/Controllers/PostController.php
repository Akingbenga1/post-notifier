<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Website;
use App\Notifications\PostNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createNewPost(Request $request)
    {
        Log::info(' PostController  createNewPost  Request  ========>  '.json_encode($request->all()));
        // Get  Website create details and save to DB

        $newPost = null;
        $status = false;
        $validator = Validator::make($request->all(), Post::$rules, Post::$messages);

        if ($validator->fails())
        {
            $message = $validator->messages()->first();
        }
        else
        {
            $data = $request->all();
            $newPost =  Post::create($data);
            Log::info(' PostController    website_id  ========>  '.json_encode($newPost));
            $this->notfityUsers($newPost);
            $status = true;
            $message = 'New Post created successfully.';
        }

        return response()->json([
            'message' => $message,
            'success' => $status,
            'data' => [
                'post' => $newPost
            ]
        ]);
    }

    public function notfityUsers(Post $post)
    {
        try {
            if(!is_null($post))
            {
                $website = Website::where('id', $post->website_id )->with('users')->first();
                if(!is_null($website))
                {
                    $websiteUsers = $website->users;
                    foreach(  $websiteUsers as $user )
                    {
                        $user->notify(new PostNotification($post, $website));
                    }

                }
            }

            return  $response = [
                'status' => true,
                'message' => "Notification sent successfully.",
                'responseMessage' => "Notification sent successfully.",
            ];
        }
        catch (\Exception $e) {
           return  $response = [
                'status' => false,
                'message' => "Unsuccessful",
                'responseMessage' => $e->getMessage(),
            ];
        }
    }
}
