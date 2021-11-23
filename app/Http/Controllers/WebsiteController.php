<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\WebsiteUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createNewWebsite(Request $request)
    {
        Log::info(' CreateWebsite  createNewWebsite  Request  ========>  '.json_encode($request->all()));
        // Get  Website create details and save to DB

        $newWebsite = null;
        $status = false;
        $validator = Validator::make($request->all(), Website::$rules, Website::$messages);

        if ($validator->fails())
        {
            $message = $validator->messages()->first();
        } else {
            $data = $request->all();
            $newWebsite =  Website::create($data);
            $status = true;
            $message = 'New Website created successfully.';
        }

        return response()->json([
            'message' => $message,
            'success' => $status,
            'data' => [
                'website' => $newWebsite
            ]
        ]);
    }

    public function addWebsiteUser(Request $request)
    {
        Log::info(' CreateWebsite  addWebsiteUser  Request  ========>  '.json_encode($request->all()));
        // Get  Website create details and save to DB

        $newWebsiteUser = null;
        $status = false;
        $validator = Validator::make($request->all(), WebsiteUser::$rules, WebsiteUser::$messages);

        if ($validator->fails())
        {
            $message = $validator->messages()->first();
        } else {
            $data = $request->all();
            $newWebsite =  WebsiteUser::create($data);
            $status = true;
            $message = 'New Website User attached successfully.';
        }

        return response()->json([
            'message' => $message,
            'success' => $status,
            'data' => [
                'website' => $newWebsiteUser
            ]
        ]);
    }

    public function list(Request $request)
    {
        Log::info(' CreateWebsite  list  Request  ========>  '.json_encode($request->all()));
        // Get All Websites

       $websites  = Website::all();

        return response()->json([
            'message' => "true",
            'success' => "true",
            'data' => [
                'website' => $websites
            ]
        ]);
    }
}
