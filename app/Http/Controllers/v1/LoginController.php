<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Helpers\UserHelper;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try
        {
            $requestData = $request->all();

            if (! $requestData)
            {
                throw new \Exception("Request Data is not valid.");
            }
            
            $userData = UserHelper::findByEmail($requestData['email']);

            if (! $userData instanceof User)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => __("User is not found"),
                ]);
            }

            if (! $userData->validatePassword($requestData['password']))
            {
                return response()->json([
                    'status' => 'error',
                    'message' => __("Username / Password is invalid"),
                ]);
            }

            $userData->login();

            $userData->saveOrFail();

            return response()->json([
                'status' => 'success',
                'message' => __("Successfully Login"),
                'data' => [
                    'token' => $userData->api_token,
                ],
            ]);
        }
        catch (\Throwable $th)
        {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
        
    }

    public function logout()
    {

    }
}