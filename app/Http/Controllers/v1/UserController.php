<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Helpers\UserHelper;

class UserController extends Controller
{
    public function getMe()
    {
        try 
        {
            $me = UserHelper::getLoggedInUser();

            return new UserResource($me);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}