<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\Tags;
use App\Models\BlogTag;
use App\Models\BlogCategory;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    public function ShowAllBlogs(){
        $blogs = Blogs::all();
        $tags = Tags::all();
        $categories = Categories::all();
        return view('content.blogs')->with('data', ["blogs" => $blogs, "tags" => $tags, "categories" => $categories]);
    }
    public function ShowBlog(Request $request){
        $blog = Blogs::select('*')->where('id', $request->id)->get();
        $tags = Tags::all();
        $blogtags = BlogTag::where("blog_id", "=", $request->id)->get(["tag_id"])->pluck('tag_id')->toArray();
        $categories = Categories::all();
        $blogcategories = BlogCategory::where("blog_id", "=", $request->id)->get(["category_id"])->pluck('category_id')->toArray();
        return view('content.view-blog')->with('data', ["blog" => $blog, "tags" => $tags, "categories" => $categories, "blogtags" => $blogtags, "blogcategories" => $blogcategories]);
    }
    public function ShowNewBlog(Request $request){
        $tags = Tags::all();
        $categories = Categories::all();
        return view('content.new-blog')->with('data', ["tags" => $tags, "categories" => $categories]);
    }
    public function AddNewBlog(Request $request){
        $files = $request->file('blog_image');
        if($request->hasFile('blog_image'))
        {
            $files->move('assets/img/blog/', $files->getClientOriginalName()); 
        }
        $data = Blogs::create(request()->except(['blog_image', 'blog_categories', 'blog_tags']) + ['user_id' => Auth::user()->id] + ['blog_image' => $files->getClientOriginalName()])->id;
        if(isset($request->blog_tags)){
            for($i = 0; $i < count($request->blog_tags); $i++){
                $blogtags = new BlogTag;
                $blogtags->tag_id = $request->blog_tags[$i];
                $blogtags->blog_id = $data;
                $blogtags->save();
            }
        }
        if(isset($request->blog_categories)){
            for($i = 0; $i < count($request->blog_categories); $i++){
                $blogcategories = new BlogTag;
                $blogcategories->tag_id = $request->blog_categories[$i];
                $blogcategories->blog_id = $data;
                $blogcategories->save();
            }
        }
        return redirect('/blogs/viewblog/' . $data)->with('success', 'Blog Saved!');
    }
    public function UpdateBlog(Request $request){
        $files = $request->file('blog_image');
        if($request->hasFile('blog_image'))
        {
            $files->move('assets/img/blog/', $files->getClientOriginalName()); 
        }
        $data = Blogs::where('id', $request->blog_id)->update(request()->except(['_token', 'blog_id', 'blog_image', 'blog_tags', 'blog_categories']) + ['user_id' => Auth::user()->id] + ['blog_image' => $files->getClientOriginalName()]);
        BlogTag::where("blog_id", "=", $request->blog_id)->delete();
        if(isset($request->blog_tags)){
            for($i = 0; $i < count($request->blog_tags); $i++){
                $blogtags = new BlogTag;
                $blogtags->tag_id = $request->blog_tags[$i];
                $blogtags->blog_id = $request->blog_id;
                $blogtags->save();
            }
        }

        BlogCategory::where("blog_id", "=", $request->blog_id)->delete();
        if(isset($request->blog_categories)){
            for($i = 0; $i < count($request->blog_categories); $i++){
                $blogcategory = new BlogCategory;
                $blogcategory->category_id = $request->blog_categories[$i];
                $blogcategory->blog_id = $request->blog_id;
                $blogcategory->save();
            }
        }
        return redirect('/blogs/viewblog/' . $request->blog_id)->with('success', 'Blog Updated!');
    }
    public function RemoveBlog(Request $request){
        Blogs::find($request->id)->delete();
        return redirect('/blogs')->with('success', 'Blog Deleted!');
    }
}
