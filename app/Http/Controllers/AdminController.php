<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\SheikhPartialRegistration;
use Illuminate\Support\Facades\DB;
use App\Mail\SheikhVerifyEmail;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    //todo: admin login form
    public function login_form()
    {
        return view('auth.login');
    }

    //todo: admin login functionality
    public function login_functionality(Request $request){
        $request->validate([
            'username'=>'required|email',
            'password'=>'required',
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }elseif (Auth::guard('sheikh')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->back()->with('test','Sheikh login well');
        }else{
            Session::flash('error-message','Invalid Email or Password');
            return back();
        }

    }

    public function dashboard()
    {
        return view('users.admin.dashboard');
    }

    public function forgot_password(){
        return view('auth.forgot_password');
    }

    //managing sheikh
    public function manageSheikh(){
        return view('users.admin.manage-sheikh');
    }


    //todo: admin logout functionality
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login.form');
    }

    public function send_email_to_sheikh_to_register(Request $request){
        $request->validate([
            'email' =>'required|string|email'
        ]);
        $email=$request->email;

        $done_email=SheikhPartialRegistration::all()->where('email',$email)->where('status','Done');
        $count_done_email=collect($done_email)->count();

        $not_done_email=SheikhPartialRegistration::all()->where('email',$email)->where('status','');
        $count_not_done_email=collect($not_done_email)->count();

        if ($count_done_email == 1) {
            return redirect()->back()->with("done_status_msg","This email is already registered by sheikh !");
        }elseif ($count_not_done_email == 1) {
            return redirect()->back()->with("null_status_msg","This email is not registered yet by sheikh !");
        }else{
            
            $auth_name=Auth::guard('admin')->user()->firstname." ".Auth::guard('admin')->user()->lastname;
            $encryptEmail=Crypt::encrypt($email);

            Mail::to($email)->send(new SheikhVerifyEmail($auth_name,$encryptEmail));

            DB::table('sheikh_partial_registrations')->insert([
                'email' => $email,
                'status' => ''
            ]);

            return redirect()->back()->with("mail_sent","Email sent successfully !");

        }
    
    }
}
