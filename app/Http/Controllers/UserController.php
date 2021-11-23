<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Website;
use App\Models\WebsiteUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function addUser(Request $request)
    {
        Log::info(' UserController  addUser  Request  ========>  '.json_encode($request->all()));
        // Get  Website create details and save to DB

        $newUser = null;
        $status = false;
        $validator = Validator::make($request->all(), User::$rules, User::$messages);

        if ($validator->fails())
        {
            $message = $validator->messages()->first();
        } else {
            $data = $request->all();
            $data['email_verified'] = 1;
            $newUser =  User::create($data);
            $status = true;
            $message = 'New user created successfully.';
        }

        return response()->json([
            'message' => $message,
            'success' => $status,
            'data' => [
                'user' => $newUser
            ]
        ]);
    }
}
