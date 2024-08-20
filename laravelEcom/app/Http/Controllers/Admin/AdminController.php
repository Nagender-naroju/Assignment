<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brand;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Admin.dashboard');
    }

    public function add_brand()
    { 
        return view('Admin.add_brand');
    }

    public function brands()
    {
        $brands = Brand::all();
        return view('Admin.brands',compact('brands'));
    }

    public function save_brand(Request $request)
    {
     
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'slug' => 'required',
        ]);

        $brand = new Brand();
        $brand->name = $request->brand_name;
        $brand->slug = $request->slug;
        
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move(public_path('brands'), $filename);
            $brand->image = $filename;
        }
        $brand->save();
        return redirect('/admin/add-brand')->with('status','Brand added successfully');
    }

    public function edit_brand($id)
    {
      $brand = Brand::find($id);
      return view('Admin.edit_brand', compact('brand'));
    }

    public function update_brand(Request $request)
    {

        $request->validate([
            'edit_name' => 'required|string|max:255',
            'edit_slug' => 'required',
        ]);

       $id = $request->old_id;
       $old_image = $request->old_image;
       $brand = Brand::find($id);
       $brand->name = $request->edit_name;
       $brand->slug = $request->edit_slug;
       if($request->hasFile('image'))
       {
         if(File::exists(public_path('/brands').'/'.$brand->image))
         {
            File::delete(public_path('/brands').'/'.$brand->image);
         }
        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time().'.'.$extenstion;
        $file->move(public_path('brands'), $filename);
        $brand->image = $filename;
       }else{
        $brand->image=$old_image;
       }
       $brand->save();
       return redirect('/admin/brands')->with('status','Brand has been updated successfully');
    }

    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        if(File::exists(public_path('/brands').'/'.$brand->image))
        {
           File::delete(public_path('/brands').'/'.$brand->image);
        }
        $brand->delete();
        return redirect('/admin/brands')->with('status','Brand has been deleted successfully');
    }

}
