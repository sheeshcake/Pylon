<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Portfolios;
use App\Models\SiteLogs;

class AdminController extends Controller
{
    public function ShowDashboard(){
        $blogtotal = Blogs::all()->count();
        $portfoliototal = Portfolios::all()->count();
        $sitelogs = SiteLogs::all()->count();
        return view("content.dashboard")->with("data", ["blogcount" => $blogtotal, "portofliocount" => $portfoliototal, "sitelog" => $sitelogs]);
    }


    public function ShowAllUsers(){
        $users = User::where("id", "!=", Auth::user()->id)->get();
        return view("content.users")->with("data", ["users" => $users]);
    }

    public function ShowUser(Request $request){
        $user = User::where("id", "=", $request->id)->get();
        return view("content.view-user")->with("data", ["user" => $user]);
    }

    public function ShowAddUser(){
        return view("content.new-user");
    }

    public function AddUser(Request $request){
        $files = $request->file('user_image');
        if($request->hasFile('user_image'))
        {
            $files->move('assets/img/team/', $files->getClientOriginalName()); 
        }
        $user = new User();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->user_position = $request->user_position;
        $user->user_role = $request->user_role;
        $user->user_department = $request->user_department;
        $user->user_insta = isset($request->user_insta) ? $request->user_insta : "none";
        $user->user_twitter = isset($request->user_twitter) ? $request->user_twitter : "none";
        $user->user_image = $files->getClientOriginalName();
        $user->user_fb = isset($request->user_fb) ? $request->user_fb : "none";
        $user->email = $request->email;
        $user->user_role = $request->user_role;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->plain_password = $request->password;
        $user->save();
        return redirect("accounts/viewuser/" . $user->id)->with("success", "User Added!");

    }

    public function RemoveUser(Request $request){
        User::where("id", "=", $request->id)->delete();
        return redirect("/accounts")->with("success", "User Deleted!");
    }

    public function UpdateUser(Request $request){
        $files = $request->file('user_image');
        if($request->hasFile('user_image'))
        {
            $files->move('assets/img/team/', $files->getClientOriginalName()); 
        }
        $plain_password = $request->password;
        User::where('id', $request->id)->update(request()->except(
                                ['_token', "user_image", "password"]) + 
                                [
                                    "password" => Hash::make($request->password),
                                    'user_image' => $files->getClientOriginalName(), 
                                    "plain_password" => $plain_password,
                                ]);
        return redirect("accounts/viewuser/" . $request->id)->with("success", "User Updated!");
    }

    public function ShowProfile(){
        $user = User::where("id", "=", Auth::user()->id)->get();
        return view("content.profile")->with("data", ["user" => $user]);
    }

}
