<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    // Banner List
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('backend.banners.index', compact('banners'));
    }

    // New Banner form
    public function create()
    {
        return view('backend.banners.create');
    }

    // New Banner 
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'text_color' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
        $banner->text_color = $request->text_color ?? '#000000';
        $banner->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banners'), $filename);
            $banner->image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Banner created successfully');
    }

    // Edit form
 public function edit($id)
{
    $banner = Banner::findOrFail($id); 
    return view('backend.banners.edit', compact('banner')); 
}

    // Banner Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'text_color' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->title = $request->title;
        $banner->text_color = $request->text_color ?? '#000000';
        $banner->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($banner->image && File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banners'), $filename);
            $banner->image = 'uploads/banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Banner updated successfully');
    }

    // (Active/Inactive)
    public function toggleStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = !$banner->status;
        $banner->save();

        return redirect()->back()->with('success', 'Banner status updated successfully.');
    }

    // Banner Delete
    public function delete($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image && File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }

        $banner->delete();

        return redirect()->route('banner.index')->with('success', 'Banner deleted successfully');
    }
}
