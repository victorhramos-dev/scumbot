<?php

namespace App\Http\Controllers\Api\Drone\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Drone\LoginRequest;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Login the user on the application.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $result = $this->attemptLogin($request);

        if ($result) {
            $token = Str::random(60);

            $this->guard()->user()->forceFill([
                'api_token' => $token,
            ])->save();

            return response()->json([
                'success' => true,
                'token' => $token,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password',
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return  Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('drone');
    }
}
