<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try
        {
            $this->validate($request,[
                'username' => 'required|bail',
                'password' => 'required|bail|string'
            ]);

            if(auth()->attempt(['username' => $request->username, 'password' => $request->password]))
            {
                return response()->json(auth()->user(), 200);
            }

            if(auth()->attempt(['phone_number' => $request->username, 'password' => $request->password]))
            {
                return response()->json(auth()->user(), 200);
            }

            return response()->json([
                'message' => "Invalid Login Details"
            ], 400);
        } catch(ValidationException $v)
        {
            return response()->json([
                'error_message' => $v->validator->errors()->first()
            ], 422);
        } catch(\Exception $ex)
        {
            return response()->json([
                'error_message' => ''.$ex->getMessage()
            ], 500);
        }
    }
}
