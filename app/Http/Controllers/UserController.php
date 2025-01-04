<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view("user.index");
    }
    public function about()
    {
        return view("user.about");
    }
    public function contact()
    {
        return view("user.contact");
    }
    public function blog()
    {
        $blogs = Blog::all();
        return view("user.blog",compact("blogs"));
    }
    public function service()
    {
        return view("user.services");
    }
    public function shop()
    {
        $products = Product::all();
        return view("user.shop", compact("products"));
    }
    public function cart()
    {
        $cartitem=CartItem::all();
        return view("user.services",compact("cartitem"));
    }
}
