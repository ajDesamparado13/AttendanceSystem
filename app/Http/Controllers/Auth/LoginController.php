<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return $this->success('email', $request->email);
        } else {
            return response()->json(['error' => 'Invalid Username or Password.'], 401);
        }
    }

    public function success($field, $value)
    {
        $request = app()->make('request');
        $user = User::where($field, $value)->with(['company'])->first();
        $success['token'] = $user->createToken('MyApp')->accessToken;
        return response()->json([
            'success' => $success,
            'user' => $user,
        ]);
    }
    public function logout(Request $request)
    {

        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
