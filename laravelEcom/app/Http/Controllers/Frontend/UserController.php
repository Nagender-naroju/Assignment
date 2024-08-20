<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\CategoryModel;
use App\Models\Admin\Brand;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.user_profile');
    }

    public function dashboard()
    {
        $categories = CategoryModel::all();
        $brands = Brand::all();
        return view('frontend.dashboard',compact('categories','brands'));
    }

    public function wishlist()
    {
        
        return view('frontend.wishlist');
    }

    public function cart()
    {
        return view('frontend.cart');
    }
    public function login()
    {
        return view('frontend.login');
    }
}
