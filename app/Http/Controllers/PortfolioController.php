<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolios;
use App\Models\PortfolioCategories;
use App\Models\PortfolioImages;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{

    public function ShowPortfolio(Request $request){
        $portfolio = Portfolios::select('*')->where('id', $request->id)->get();
        $portfolio_category = Portfolios::select("portfolio_categories.id")->join("portfolio_categories", "portfolio_categories.id", "=", "portfolios.category_id")->where("portfolios.id", $request->id)->get()->pluck('id')->toArray();
        $portfolio_images = PortfolioImages::join("portfolios", "portfolios.id", "=", "portfolio_images.portfolio_id")->where("portfolios.id", "=", $request->id)->get();
        $categories = PortfolioCategories::all();
        return view('content.view-portfolio')->with('data', ["portfolio" => $portfolio, "categories" => $categories, "portfoliocategory" => $portfolio_category, "portfolio_images" => $portfolio_images]);
    }

    public function ShowPortfolios(){
        $portfolios = Portfolios::all();
        $categories = PortfolioCategories::all();
        return view('content.portfolio')->with("data", ["portfolios" => $portfolios, "categories" => $categories]);
    }

    public function ShowNewPortfolio(){
        $categories = PortfolioCategories::all();
        return view('content.new-portfolio')->with("data", ["categories" => $categories]);
    }

    public function AddNewPortfolio(Request $request){
        $files = $request->file('portfolio_image');
        $data = Portfolios::create(request()->except(['portfolio_image']) + ['user_id' => Auth::user()->id])->id;
        foreach($files as $file){
            if($request->hasFile('portfolio_image')){
                $file->move('assets/img/portfolio/', $file->getClientOriginalName());
                $images = new PortfolioImages();
                $images->portfolio_id = $data;
                $images->image_name = $file->getClientOriginalName();
                $images->save();
            }
        }
        return redirect('/portfolio/viewportfolio/' . $data)->with('success', 'Blog Saved!');
    }

    public function UpdatePortfolio(){


    }

    public function RemovePortfolio(Request $request){
        $portfolio = Portfolios::where("id", "=", $request->id)->get();
        $images = PortfolioImages::where("portfolio_id", "=", $request->id)->get();
        foreach($images as $image){
            unlink('assets/img/portfolio/' . $image->image_name);
        }
        PortfolioImages::where("portfolio_id", "=", $request->id)->delete();
        Portfolios::where("id", "=", $request->id)->delete();
        return redirect('/portfolio')->with('success', 'Portfolio Deleted!');

    }

    
}
