<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    function index($id = null)
    {
        $editedBrand = null;
        $brands = Brand::get();
        return view('Backend.Brands.index', compact('editedBrand', 'brands'));
    }



    function storeOrUpdate(Request $request, $id = null)
    {
        //* Validation
        $request->validate([
            'title' => "required|min:3|unique:brands,title",
            'icon' => 'mimes:jpg,jpeg,png'
        ]);
        if ($request->hasFile('icon')) {
            $iconName = $request->title . "." . $request->icon->extension();
            $icon =   $request->icon->storeAs('brands', $iconName, 'public');
        }

        $brand = new Brand();
        $brand->title = $request->title;
        $brand->icon = $icon ?? null;
        $brand->save();
        return to_route('brand.index');


    }
}
