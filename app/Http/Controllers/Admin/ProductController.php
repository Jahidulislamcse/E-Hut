<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index(){
        $products = Product::latest()->get();
        return view('admin.allproduct', compact('products'));
    }

    public function AddProduct(){
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        return view('admin.addproduct', compact('categories', 'subcategories'));
    }

    public function StoreProduct(Request $request){
        $request->validate([
            'product_name' => 'required|unique:products',
            'product_short_description'=> 'required',
            'product_long_description'=> 'required',
            'price'=> 'required',
            'product_category_id'=> 'required',
            'product_sub_category_id'=> 'required',
            'product_img'=> 'required|image|mimes:jpeg,jpg,png',
            'quantity' => 'required',
        ]);

        $image = $request->file('product_img');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$image_name);
        $image_url = 'upload/'.$image_name;

        $category_id =  $request->product_category_id;
        $product_category_name = Category::where('id', $category_id)->value('category_name');

        $subcategory_id =  $request->product_sub_category_id;
        $product_sub_category_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'price' => $request->price,
            'product_category_name' => $product_category_name,
            'product_sub_category_name' => $product_sub_category_name,
            'product_category_id' => $request->product_category_id,
            'product_sub_category_id' => $request->product_sub_category_id,
            'product_img' => $image_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        ]);

        Category::where('id', $category_id)->increment('product_count',1);
        Subcategory::where('id', $subcategory_id)->increment('product_count',1);

        return redirect()->route('allproduct')->with('message',' Product Added successfully');
    }
    public function EditProductImage($id){
        $productinfo = Product::findOrFail($id);
        return view('admin.editproductimage', compact('productinfo'));
    }

    public function UpdateProductImage(Request $request){

        $request->validate([
            'product_img'=> 'required|image|mimes:jpeg,jpg,png',
        ]);

        $id = $request->id;
        $image = $request->file('product_img');
        $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'),$image_name);
        $image_url = 'upload/'.$image_name;

        Product::findOrFail($id)->update([
            'product_img' => $image_url
        ]);
        return redirect()->route('allproduct')->with('message',' Image updated successfully');
    }

    public function EditProduct($id){
        $product_info = Product::findOrFail($id);

        return view('admin.editproduct', compact('product_info'));
    }

    public function UpdateProduct(Request $request){
        $product_id = $request->id;

        $request->validate([
            'product_name' => 'required|unique:products',
            'product_short_description'=> 'required',
            'product_long_description'=> 'required',
            'price'=> 'required',
            'quantity' => 'required',
        ]);

        Product::findOrFail($product_id)->update([
            'product_name' => $request->product_name,
            'product_short_description' => $request->product_short_description,
            'product_long_description' => $request->product_long_description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        ]);
        return redirect()->route('allproduct')->with('message',' Product updated successfully');
    }

    public function DeleteProduct($id){
        $product_category_id = Product::where('id', $id)->value('product_category_id');
        $product_sub_category_id = Product::where('id', $id)->value('product_sub_category_id');
        Product::findOrFail($id)->delete();
        Category::where('id', $product_category_id)->decrement('product_count', 1 );
        Subcategory::where('id', $product_sub_category_id)->decrement('product_count', 1 );

        return redirect()->route('allproduct')->with('message',' Product Deleted successfully');
    }
}

