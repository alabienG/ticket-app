<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SigninController extends Controller
{
    public function index(){

        return view('signin.login');
    }

    public function login(Request $request){
        $email = $request->email;
        $pass = $request->password;
        $result= Auth::attempt(['email'=>$email, 'password'=>$pass]);
        if(!$result){
            $message="Adresse mail ou mot de passe incorrect";
            return back()->with('message', $message);
        }
        return redirect()->route('tickets');
    }

    public function deconnexion(Request $request){
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');

    }
}
