<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;
use Redirect;
use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use App\Models\VA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function ShowLogin(){
        if(Auth::check()){
            if(Auth::user()->user_role == "admin"){
                return redirect('dashboard');
            }else if(Auth::user()->user_role == "client"){
                return redirect('rooms');
            }
            else{
                return redirect('timetrack');
            }
        }else{
            if(User::all()->isEmpty()){
                return redirect('register');
            }else{
                return View::make('content.login');
            }
        }
    }

    public function DoLogin(Request $request){
        $rules = array(
            'username' => 'required|alphaNum|min:3',
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return Redirect::back()->withInput($request->input())->with([
                'msg' => 'Username or Password is incorrect.',
                'status' => 'danger'
            ]);
        }else{
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if(Auth::user()->user_role == "admin"){
                    return redirect('dashboard');
                }else if(Auth::user()->user_role == "client"){
                    return redirect('rooms');
                }
                else{
                    return redirect('timetrack');
                }
                
            }else{
                return Redirect::back()->withInput($request->input())->with([
                    'msg' => 'Username or Password is incorrect.',
                    'status' => 'danger'
                ]);
            }
        }
    }
}
