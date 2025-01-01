<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.addproduct');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('view.product')->with('success', 'Product created successfully!');
    }
    
    public function view()
    {
        $products = Product::all();
        return view('admin.view-product', compact('products'));
    }
     public function edit(Product $product)
     {
         return view('admin.edit-product', compact('product'));
     }
 
     public function update(Request $request, Product $product)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'required|string',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
 
         if ($request->hasFile('image')) {
             $imagePath = $request->file('image')->store('images', 'public');
         }
 
         $product->update([
             'name' => $request->name,
             'description' => $request->description,
             'image' => isset($imagePath) ? $imagePath : $product->image,
         ]);
 
         return redirect()->route('admin.view-product')->with('success', 'Product updated successfully!');
     }
 
     public function destroy(Product $product)
     {
         $product->delete();
         return redirect()->route('view.product')->with('success', 'Product deleted successfully!');
     }
}
