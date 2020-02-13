<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
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

    public function username()
    {
        return 'username';
    }

    // public function login(Request $request)
    // {   
    //     $input = $request->all();
        
        
    //         $this->validate($request, [
    //             'username' => 'required|exists:users,username',
    //             'password' => 'required|string',
    //         ]);   

   
    //     if(auth()->attempt(array('username' => $input['username'], 'password' => $input['password'])))
    //     {
    //         if (auth()->user()->is_admin == '1') {
    //             return redirect()->route('admin.home');
    //         }else{
    //             return redirect()->route('user.home');
    //         }   
    //     }
    //     else{
    //
    //      return redirect()->route('login')->with('error','Invalid username/password!');
    //         return $this->sendFailedLoginResponse($request);
    //     }
          
    // }

    protected function authenticated(Request $request, $user)
    {
        //
            if (auth()->user()->is_admin == '1') {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('employee.home');
            }  
    }

    protected function validateLogin(Request $request)
    {

        $request->validate([
            $this->username() => 'required',
            'password' => 'required|string',
        ]);

    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
