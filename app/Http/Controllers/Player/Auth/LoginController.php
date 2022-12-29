<?php

namespace App\Http\Controllers\Player\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/cliente';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('player.logged')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return  Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('front.templates.player.auth.login');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return  Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        session()->put('player-login', $this->guard()->user());

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Sets redirect path
     *
     * @return  string
     */
    public function redirectTo()
    {
        $redirectTo = session()->pull('login-redirect');

        return $redirectTo ? $redirectTo : $this->redirectTo;
    }

    /**
     * Log the user out of the application.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $player = $this->guard()->user();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->put('player-logout', $player);

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return  Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('player');
    }
}
