<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;
use App\Http\Controllers\Redirect;

class TagsController extends Controller
{
    public function AddTag(Request $request){
        $tags = new Tags();
        $tags->tag_name = $request["tag_name"];
        $tags->save();
        return back()->with("success", "Tag Added!");
    }
    public function UpdateTag(Request $request){
        Tags::where("id", "=", $request->id)->update(["tag_name" => $request->tag_name]);
        echo "Tag Updated!";
    }
    public function RemoveTag(Request $request){
        Tags::where("id", "=", $request->id)->delete();
        echo "Tag Deleted!";
    }
}
