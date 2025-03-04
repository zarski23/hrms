<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
	try{

        $request->session()->regenerate();

        $request->validate([
            'username' => 'required|string',  
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        // Retrieve the user from the database by their username
        $user = User::where('username', $username)->first();
        $employeeCount = DB::table('users')->where('id', '<>', 1)->count();

        if ($user && sha1($password) === $user->password) {
            // Password matches; log the user in
            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            
            if($user->status == "active"){
                Auth::login($user);
                Session::put('user_id', $user->id);
                Session::put('first_name', $user->first_name);
                Session::put('middle_name', $user->middle_name);
                Session::put('last_name', $user->last_name);
                Session::put('email', $user->email);
                Session::put('username', $user->username);
                Session::put('date_hired', $user->date_hired);
                Session::put('hr_user_role', $user->hr_user_role);
                Session::put('status', $user->status);
                Session::put('employeeCount', $employeeCount);
    
                $activityLog = ['user_id'=> Session::get('user_id'), 'description' => 'Logged in','date_time'=> $todayDate,];
                DB::table('user_logs')->insert($activityLog);
		
                Toastr::success('Login successfully', 'Success');
                return redirect()->intended(RouteServiceProvider::HOME); //redirect to service provider then route to home controller to check user role
            }else{
                Toastr::error('Your account is deactivated, <br> Please contact HR Admin', 'LOGIN FAILED!');
                return back();
            }
            
        }
        else {
            Toastr::error('Wrong Username or Password', 'LOGIN FAILED!');
            return back();
        }
    }catch(\Exception $e){
            DB::rollback();
            dd($e);
            Toastr::error('Data Entry fail','Error');
            return redirect()->back();
        }	

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $dt = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = ['user_id'=> Session::get('user_id'), 'description' => 'Logged out','date_time'=> $todayDate,];
        DB::table('user_logs')->insert($activityLog);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        
        Toastr::info('Logout successfully','Success');
        return redirect('/');
    }
}
 