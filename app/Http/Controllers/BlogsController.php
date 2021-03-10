<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Facades\Auth;

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
    public function ShowNewBlog(Request $request){
        return view('content.new-blog');
    }
    public function AddNewBlog(Request $request){
        $files = $request->file('blog_image');
        if($request->hasFile('blog_image'))
        {
            $files->move('assets/img/blog/', $files->getClientOriginalName()); 
        }
        $data = Blogs::create(request()->except(['blog_image']) + ['user_id' => Auth::user()->id] + ['blog_image' => $files->getClientOriginalName()])->id;
        return redirect('/blogs/' . $data)->with('success', 'Blog Saved!');
    }
    public function UpdateBlog(Request $request){
        $files = $request->file('blog_image');
        if($request->hasFile('blog_image'))
        {
            $files->move('assets/img/blog/', $files->getClientOriginalName()); 
        }
        $data = Blogs::where('id', $request->blog_id)->update(request()->except(['_token', 'blog_id', 'blog_image']) + ['user_id' => Auth::user()->id] + ['blog_image' => $files->getClientOriginalName()]);
        return redirect('/blogs/' . $request->blog_id)->with('success', 'Blog Updated!');
    }
    public function RemoveBlog(Request $request){
        Blogs::find($request->id)->delete();
        return redirect('/blogs')->with('success', 'Blog Deleted!');
    }
}
