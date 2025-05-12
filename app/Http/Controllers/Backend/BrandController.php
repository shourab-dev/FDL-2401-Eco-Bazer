<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    function index($id = null)
    {
        $editedBrand = Brand::find($id) ??  null;
        $brands = Brand::get();

        return view('Backend.Brands.index', compact('editedBrand', 'brands'));
    }



    function storeOrUpdate(Request $request, $id = null)
    {
        //* Validation
        $request->validate([
            'title' => "required|min:3|unique:brands,title,$id",
            'icon' => 'mimes:jpg,jpeg,png'
        ]);
        if ($request->hasFile('icon')) {
            $iconName = $request->title . "." . $request->icon->extension();
            $icon =   $request->icon->storeAs('brands', $iconName, 'public');
        }
        $brand = Brand::findOrNew($id);
        $brand->title = $request->title;
        if ($request->hasFile('icon') && isset($brand->icon)) {
            Storage::disk('public')->delete($brand->icon);
        }
        $brand->icon = $icon ?? $brand->icon;
        $brand->save();
        notify()->success('Brand inserted successfully');

        return to_route('brand.index');
    }
}
