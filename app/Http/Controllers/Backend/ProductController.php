<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
  function create()
  {
    // $categories = Category::where('status',  true)->latest()->get();
    $brands = Brand::where('status',  true)->latest()->get();

    return view('backend.products.create', compact('brands'));
  }



  function store(Request $request){
    dd($request->all());
  }


  function liveCategory(Request $request){
    // dd($request->all());
    $categories = Category::query()->where('status', true)->select('id','title');
    $search = $request->search;
    if($search){
      $categories->whereLike('title', "%$search%");
    }
    $categories = $categories->limit(2)->latest()->get();

    $resArr = [];

    foreach($categories as $category){
      $resArr[] = [
        'id' => $category->id,
        'text'=> $category->title,
      ];
    }

    return response()->json($resArr);




  }


}
