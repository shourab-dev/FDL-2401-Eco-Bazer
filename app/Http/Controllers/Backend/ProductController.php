<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  function create()
  {
    // $categories = Category::where('status',  true)->latest()->get();
    $brands = Brand::where('status',  true)->latest()->get();

    return view('backend.products.create', compact('brands'));
  }



  function store(ProductRequest $request, $id = null)
  {

    $slug = $this->slugGenerator($request->slug, $request->title);
    if (!$slug) {
      return to_route('products.create')->withErrors(['slug' => 'this slug is already in use.']);
    }

    $product =  Product::findOrNew($id);

    //* Image Upload
    if ($request->file('featuredImage')) {

      if ($product->featured_image) {
        Storage::disk('public')->delete($product->featured_image);
      }

      $name = $slug . "." . $request->featuredImage->extension();
      $featuredImage  = $request->featuredImage->storeAs('products', $name, 'public');
      $product->featured_image = $featuredImage;
    }

    //* Gallery Images
    if (count($request->galleryImages) > 0) {
      $gallaries = [];
      foreach ($request->galleryImages as $gall) {
        $name = $slug . "_" . time() . "." . $gall->extension();
        $gallery  = $gall->storeAs('products', $name, 'public');
        $gallaries[] = $gallery;
      }

      $product->gallery_images = json_encode($gallaries);
    }

    $product->title = $request->title;
    $product->slug = $slug;
    $product->price = $request->price;
    $product->selling_price = $request->selling_price;
    $product->qty = $request->qty;
    $product->brand_id = $request->brand;
    $product->category_id = $request->category;
    $product->short_detail = $request->short_detail;
    $product->long_detail = $request->long_detail;
    $product->alert_qty = $request->alert_qty ?? 0;
    $product->sku = $request->sku;
    $product->additional_info = $request->additional_info;
    $product->video = $request->video_url;

    $product->save();
    return back();
  }


  private function slugGenerator($slug, $title)
  {

    if ($slug) {
      $isExists = Product::where('slug', $slug)->exists();
      if ($isExists) {
        return false;
      } else {
        return $slug;
      }
    } else {
      $slug = str($title)->slug();
      $count = Product::whereLike('slug', "%$slug%")->count();

      if ($count > 0) {
        $count += 1;
        $slug = $slug . "-$count";
        return $slug;
      }
      return $slug;
    }
  }


  function liveCategory(Request $request)
  {
    // dd($request->all());
    $categories = Category::query()->where('status', true)->select('id', 'title');
    $search = $request->search;
    if ($search) {
      $categories->whereLike('title', "%$search%");
    }
    $categories = $categories->limit(2)->latest()->get();

    $resArr = [];

    foreach ($categories as $category) {
      $resArr[] = [
        'id' => $category->id,
        'text' => $category->title,
      ];
    }

    return response()->json($resArr);
  }
}
