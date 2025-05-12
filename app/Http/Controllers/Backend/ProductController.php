<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
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
    
    $product = new Product();
    $product->title = $request->title;
    $product->price = $request->price;
    $product->selling_price = $request->selling_price;
    $product->qty = $request->qty;
    $product->brand_id = $request->brand;
    $product->category_id = $request->category;
    $product->short_detail = $request->short_detail;
    $product->long_detail = $request->long_detail;
    $product->alert_qty = $request->alert_qty ?? 0;
    $product->sku = $request->sku;
    $product->addtional_info = $request->addtional_info;
    $product->video = $request->video_url;
    $product->slug = $request->slug ?? str($request->title)->slug();
    $product->save();
    


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
