<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('rolechecker');
  }
    function productjoinview() {
      $categories = Category::all();
      $products = Product::all();
      return view('product/view', compact('products', 'categories'));
    }
    function productjoinpush(Request $request) {
      // echo $request->product_name;
      // echo $request->product_dct;
      // echo $request->product_price;
      // echo $request->product_quantity;
      // echo $request->product_quantity_alert;
      $request->validate([
        'product_name' => 'required',
        'product_dct' => 'required',
        'product_price' => 'required|numeric',
        'product_quantity' => 'required|numeric',
        'product_quantity_alert' => 'required|numeric',
      ]);
      $lastinsertedid = Product::insertGetId([
        'category_id' => $request->category_id,
        'product_name' => $request->product_name,
        'product_dct' => $request->product_dct,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_quantity_alert' => $request->product_quantity_alert,
        'created_at' => Carbon::now()
      ]);
      if($request->hasFile('product_image')){
        $main_image = $request->product_image;
        $image_name = $lastinsertedid.'.'.$main_image -> getClientOriginalExtension();
        Image::make($main_image)->resize(400, 450)->save(base_path('public/uploads_file/product_image/'.$image_name));
        Product::find($lastinsertedid)->update([
          'product_image' => $image_name,
        ]);
      }

      return back()->with('status', ('Product Added Successfully'));
    }
    function producterase($product_id) {
      Product::find($product_id)->delete();
      return back();
    }
    function productupgrade($product_id) {
      $categories = Category::all();
      $product_info = Product::findOrFail($product_id);
      return view('product/upgrade', compact('product_info', 'categories'));
    }
    function productupgradepush(Request $request) {
      Product::find($request->product_id)->update([
        'product_name' => $request->product_name,
        'category_id' => $request->category_id,
        'product_dct' => $request->product_dct,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_quantity_alert' => $request->product_quantity_alert,
      ]);
      if($request->hasFile('product_image')){
        if(Product::find($request->product_id)->product_image != 'defaultImage.jpg') {
          $deletename = Product::find($request->product_id)->product_image;
          unlink(base_path('public/uploads_file/product_image/'.$deletename));
        }
        $main_image = $request->product_image;
        $image_name = $request->product_id.'.'.$main_image -> getClientOriginalExtension();
        Image::make($main_image)->resize(400, 450)->save(base_path('public/uploads_file/product_image/'.$image_name));
        Product::find($request->product_id)->update([
          'product_image' => $image_name,
        ]);
      }
      return back();
    }
}
