<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
  
    public function index(){
        $user = User::with('contact')->find(44);
        return $user;
    }

    public function register(Request $req){
        $data = $req->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
        ]);
        $user = User::create($data);
        if($user){
            return redirect()->route('signin')->with('success','account created Sussfuly');
        }else{
            echo 'ok';
            echo '<pre>';
            print_r($user);
            echo '</pre>';
        }
    }

    public function login(Request $req){
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('signin');
    }

    public function profile(int $id){
        if(!Gate::allows('validUser',$id)){
            abort(403);
        }
        $user = User::findorfail($id);
        return $user;
    }
}
