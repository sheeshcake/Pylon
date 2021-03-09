<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __invoke(LoginRequest $request) 
    {
        if ($request->method('post')) {
            $this->doLogin($request);
        } else {
           $this->checkLoggedIn();
        }
    }

   private function checkLoggedIn() 
   {
       if (auth()->check()) {
            return redirect('/dashboard');
       } else {
            return view('content.login');
       }
   }

   private function doLogin($request) 
   {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return Redirect::back()->withInput($request->input())->with([
                'msg' => 'Username or Password is incorrect.',
                'status' => 'danger'
            ]);
        }
   }
}
