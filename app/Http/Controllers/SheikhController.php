<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SheikhPartialRegistration;
USE Illuminate\Support\Facades\DB;
USE Illuminate\Support\Facades\Crypt;

class SheikhController extends Controller
{
    public function verify_email(Request $request)
    {
        // Retrieve the 'email' query parameter from the request
        $encryptedEmail = $request->query('email');

        if ($encryptedEmail) {
            try {
                // Decrypt the email
                $got_email = Crypt::decrypt($encryptedEmail);

                // Pass the decrypted email to the view
                return view('users.sheikh.verify_email', ['got_email' => $got_email]);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                // Handle decryption failure
                // For example, redirect back with an error message
                return redirect()->back()->with('error', 'Failed to decrypt email.');
            }
        } else {
            // Handle case when 'email' parameter is not provided
            // For example, redirect back with an error message
            return redirect()->back()->with('error', 'Email parameter is missing.');
        }
    }

    public function submit_verify_email(Request $request){

        $this->validate($request,[
            'email' => 'required|email|exists:sheikh_partial_registrations'
        ],[
            'email.exists' => 'Email not found in our database ,try another one !'
        ]);

        $email=$request->email;

        $exist_email=SheikhPartialRegistration::all()->where('email',$email);

        foreach ($exist_email as $key => $value) {
            $got_email=$value->email;
            $got_status=$value->status;
        }

        if($got_status == null){
            return redirect()->back()->with('email_msg_status','Email verified , continue registration !',compact('got_email'));
        }else{
            return redirect()->back()->with('email_msg_already_used',''.$got_email.'');
        }

        
    }

    public function Sheikh_self_registration_form(){
        return view('users.sheikh.self_registration');
    }

    public function sheikh_submit_form_data(Request $request){
        $this->validate($request,[
            'firstname'=>'required|string|',
            'lastname'=>'required|string|',
            'email'=>'required|string|email|unique:sheikhs',
            'phone'=>'required|string|unique:sheikhs',
            'gender'=>'required|string|',
            'country'=>'required|string|',
            'title'=>'required|string|',
            'faculty'=>'required|string|',
            'username'=>'required|string|',
            'password'=>'required|string|between:8,32|confirmed',
            'password_confirmation' => 'required'
        ],[
            'password_confirmation.required' => 're_enter password field is required',
            'password.confirmed' => 'password entered does not much ',
        ]);

        $fname=$request->firstname;
        $lname=$request->lastname;
        $email=$request->email;
        $phone=$request->phone;
        $gender=$request->gender;
        $country=$request->country;
        $title=$request->title;
        $faculty=$request->faculty;
        $username=$request->username;
        $password=bcrypt($request->password);

        DB::table('sheikhs')->insert([
            'firstname'=> $fname,
            'lastname'=> $lname,
            'email'=> $email,
            'phone'=> $phone,
            'gender'=> $gender,
            'country'=> $country,
            'title'=> $title,
            'faculty'=> $faculty,
            'username'=> $username,
            'password'=> $password,
            'image' => 'user.png'
        ]);

        DB::table('sheikh_partial_registrations')->where('email',$email)
        ->update(['status' => '','status' => 'Done']);

        return redirect()->back()->with("register_well","Registered Successfully ! , You can login now");
    }
}
