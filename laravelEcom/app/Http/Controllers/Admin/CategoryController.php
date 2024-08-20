<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CategoryModel;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::all();
        return view('Admin.categories',compact('categories'));
    }

    public function save_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required',
        ]);

        $category = new CategoryModel();
        $category->category_name = $request->category_name;
        $category->status = $request->status;

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move(public_path('category_images'), $filename);
            $category->category_image = $filename;
        }
        
        if($category->save()){
            echo json_encode(array('status'=>'200','message'=>"Category Added successfully"));
        }else{
            echo json_encode(array('status'=>'400','message'=>"Failed to add category"));
        }


    }
}
