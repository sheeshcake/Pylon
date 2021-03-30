<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioCategories;

class PortfolioCategoriesController extends Controller
{
    public function AddCategory(Request $request){
        $categories = new PortfolioCategories();
        $categories->category_name = $request["category_name"];
        $categories->category_content = $request["category_content"];
        $categories->save();
        $id = $categories->id;
        return redirect("services/viewservices/" . $id)->with('success', 'Services Saved!');
    }
    public function UpdateCategory(Request $request){
        PortfolioCategories::where("id", "=", $request->id)->update(["category_name" => $request->category_name, "category_content" => $request->category_content]);
        return redirect("services/viewservices/" . $request->id)->with('success', 'Services Updated!');
    }
    public function RemoveCategory(Request $request){
        PortfolioCategories::where("id", "=", $request->id)->delete();
        return redirect("services")->with('success', 'Services Deleted!');
    }
    public function ShowAllCategoryBlog(){
        $categoryblog = PortfolioCategoriesBlog::join("portfolio_categories", "portfolio_categories.id", "=", "portfolio_categories_blog.portfoliocategories_id")->get();
        // return view()
    }
    public function ShowAllCategory(){
        $services = PortfolioCategories::all();
        return view("content.category-blog")->with("data", ["services" => $services]);
    }

    public function ShowAddCategory(){
        return view("content.new-category-blog");
    }

    public function ShowCategory(Request $request){
        $services = PortfolioCategories::where("id", "=", $request->id)->get();
        return view("content.view-category-blog")->with("data", ["services" => $services]);
    }

}
