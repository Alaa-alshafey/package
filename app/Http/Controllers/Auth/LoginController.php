<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Tymon\JWTAuth\Contracts\Providers\Auth;

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
//    protected $redirectTo = '/dashboard';


    protected function authenticated($request, $user){

        if(!$user->is_verified){
            alert()->error('من فضلك قم بتفعيل حسابك الشخصي')->autoclose(50000);
            \auth()->logout();
            return redirect()->route('active');
        }
    }


    protected function redirectTo()
    {
        $user = auth()->user();
        if($user->is_admin)
            return '/dashboard';
        else{
            //\auth()->logout();
            if(!$user->is_verified)
              return '/active/user';
            else
                return '/';
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function adminLogin(){
        return view('auth.admin_login');
    }

//    public function showLoginForm()
//    {
//        return view('admin.login');
//    }
}
