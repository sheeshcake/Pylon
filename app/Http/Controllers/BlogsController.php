<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;

class BlogsController extends Controller
{
    public function ShowAllBlogs(){
        $blogs = Blogs::all();
        return view('content.blogs')->with('blogs', $blogs);
    }
    public function ShowBlog(Request $request){
        $blog = Blogs::select('*')->where('id', $request->id)->get();
        return view('content.view-blog')->with('blog', $blog);
    }
    public function NewBlog(Request $request){
        
    }
}
