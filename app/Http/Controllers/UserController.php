<?php

namespace App\Http\Controllers;

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
        return view("user.blog");
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
}
