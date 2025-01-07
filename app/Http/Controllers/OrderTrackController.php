<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderTrackController extends Controller
{
    public function index()
    {
        return view("admin.order-track");
    }
}
