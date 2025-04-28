<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index($id = null){
        $categories = Category::latest()->get();
        $editedCategory = null;

        if($id){
            $editedCategory = $categories->where('id', $id)->first();
        }

        return view('Backend.Category.index', compact('categories', 'editedCategory'));
    }
    

    function storeOrUpdate(Request $request, $id = null){
        $request->validate([
            'title'=> 'required|min:3',
        ]);
        
        $isExists = Category::where('id', '!=', $id)->where('slug', str()->slug($request->title))->exists();
        if($isExists){
            return back()->withErrors(['title'=> 'This title already exists']);
            exit();
        }
        
        
        $category = Category::findOrNew($id);
        $category->title = $request->title;
        $category->slug  = str()->slug($request->title);
        if($id){
            $category->status = $request->status ?? false;
        }
        $category->save();
        return back();
        
    }



    function delete($id){
        Category::findOrFail($id)->delete();
        return back();
    }
}
