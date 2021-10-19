<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Hash;
// use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function index()
    {

      return view('change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
          'current_password' => 'required',
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required',
          
        ]);

        $user = Auth::user();
        $logout = $request->logout;
        if (\Hash::check($request->current_password, $user->password)) {   
            if (!Hash::check($request->password , $user->password)) {
                // if($logout=="checked"){
                    
                // }

                $user->password = Hash::make($request->password);
                $user->passchange_status = $request->logout;
                    $user->save();
                    // if(1>2){
                    // Auth::logoutOtherDevices($request->current_password);
                    // }
                    return back()->with('success', 'Password successfully changed!');
            }
            else{
                return back()->with('error', 'New Password can not be the Old Password');
            }
        }

        else
        {
            return back()->with('error', 'Current password does not match');
        }
            



               
                 


    //     $user = Auth::user();

    //     if (!Hash::check($request->current_password, $user->password)) {           
    //     return back()->with('error', 'Current password does not match!');
    // }      

    //     $user->password = Hash::make($request->password);
    //     $user->save();
    //     return back()->with('success', 'Password successfully changed!');



    }
}