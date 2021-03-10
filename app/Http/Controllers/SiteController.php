<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\User;

class SiteController extends Controller
{
    public function ShowSite(){
        $blogs = Blogs::all();
        return view('welcome')->with('data', ['blogs' => $blogs]);
    }
    public function ShowBlog(Request $request){
        $blog = Blogs::join('users', 'users.id', '=', 'blogs.user_id')->where('blogs.id', $request->id)->get();
        return view('landingcontent.single-blog')->with('blog', $blog);
    }
    public function ShowAllBlog(){
        $blogs = Blogs::all();
        return view('landingcontent.blogs')->with('blogs', $blogs);
    }
}
