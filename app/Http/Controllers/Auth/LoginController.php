<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required' 
        ]);
    
        if (Auth::attempt($validated)) {
           $user = Auth::user();
            if ($user->is_admin == 1) {
                session()->flash('swl', [
                    'title' => '🎉 Login Successful!',
                    'message' => 'Welcome back, Admin! You have logged in successfully.',
                    'type' => 'success',
                ]);
                return redirect()->route('admin.home'); 
            } else {
                return redirect()->route('home'); 
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Email or password')->withInput();
        }
    }
    


    public function adminLogin(){
        return view('auth.adminLogin');
    }

    public function adminLogout(){
        if(Auth::check()){
            Auth::logout();
            session()->flash('notyf',[
                'type'=>'success',
                'message'=>'Your are logged out!'
            ]);
            return redirect()->route('admin.login');
        }
    }
}
