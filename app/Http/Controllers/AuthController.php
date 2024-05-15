<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function signup(){
        return view('auth.signup');
    }

    public function login(Request $request){
        $request -> validate([
           'username'=>'required',
           'password'=>'required'
        ]);


        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('/dashboard')->withSuccess('Signed In Successfully');
        }
        return redirect('/')->withFail("Invalid credentials");

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
  
        return Redirect('/')->withSuccess('Logged Out Successfully!!');
    }

    public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'confpassword'=>'required'
        ]);

        if($request['password'] != $request['confpassword']){
            return back()->withFail('Please type same password for confirmation');
        }

        $data = $request->all();

        $user = $data['username'];
        $username = DB::table('users')->where('username', "$user")->value('username');
        if($user == $username){
            return back()->withFail('Username already in use');
        }

        $check = $this->create($data);
        return redirect()->intended('/')->withSuccess('User Registered Successfully!!');
    
    }

        public function create(array $data){

            return User::create([
                'username'=>$data['username'],
                'email' => $data['email'],
                'password' => FacadesHash::make($data['password'])
                
            ]);
            
        }



}
