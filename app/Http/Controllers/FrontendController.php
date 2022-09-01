<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Carbon\Carbon;
use App\Cart;
use App\Coupon;
use App\User;

class FrontendController extends Controller
{
    function about() {
      return view('about');
    }
    function contact() {
      return view('contact');
    }
    function index() {
      $categories = Category::all();
      $products = Product::all();
      return view('welcome', compact('products', 'categories'));
    }
    function productdetails($product_id) {
      $singleproduct =  Product::find($product_id);
      $related_products = Product::where('category_id' ,$singleproduct->category_id)->where('id', '!=', $product_id)->get();
      return view('productdetails', compact('singleproduct', 'related_products'));
    }
    function categorywiseproduct($category_id) {
      $products = Product::where('category_id', $category_id)->get();
      return view('categorywiseproduct', compact('products'));
    }
    function addtocart($product_id) {
      $ip_address = $_SERVER['REMOTE_ADDR'];
      if(Cart::where('customer_id', $ip_address)->where('product_id', $product_id)->exists()) {
        Cart::where('customer_id', $ip_address)->where('product_id', $product_id)->increment('product_quantity', 1);
        return back();
      }
      else {
        Cart::insert([
          'customer_id' => $ip_address,
          'product_id' => $product_id,
          'created_at' => Carbon::now(),
        ]);
        return back();
      }
    }
    function cart($coupon_name = "") {
      if($coupon_name == ""){
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $cart_items = Cart::where('customer_id', $ip_address)->get();
        $coupon_discount_amount = 0;
        return view('cart', compact('cart_items', 'coupon_discount_amount', 'coupon_name'));
      }
      else{
        if(Coupon::where('coupon_name', $coupon_name)->exists()){
          if(Carbon::now()->format('Y-m-d') <= Coupon::where('coupon_name', $coupon_name)->first()->valid_till){
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $cart_items = Cart::where('customer_id', $ip_address)->get();
            $coupon_discount_amount = Coupon::where('coupon_name', $coupon_name)->first()->discount_amount;
            return view('cart', compact('cart_items', 'coupon_discount_amount', 'coupon_name'));
          }
          else {
            echo "invalid";
          }
        }
        else{
          echo "Coupon NO";
        }
      }
    }
    function erasecart() {
      $ip_address = $_SERVER['REMOTE_ADDR'];
      Cart::where('customer_id', $ip_address)->delete();
      return back();
    }
    function singlecartdelete($cart_id) {
      Cart::find($cart_id)->delete();
      return back();
    }
    function updatecart(Request $request) {
      $ip_address = $_SERVER['REMOTE_ADDR'];
      foreach ($request->product_id as $key_of_product_id => $value_of_product_id) {
        if (Product::find($value_of_product_id)->product_quantity >= $request->user_quantity[$key_of_product_id]) {
          Cart::where('customer_id', $ip_address)->where('product_id', $value_of_product_id)->update([
            'product_quantity' => $request->user_quantity[$key_of_product_id],
          ]);
        }
        else {
          echo "not";
        }
      }
      return back();
    }
    function customerregister() {
      return view('customerregister');
    }
    function customerregisterinsert(Request $request) {
      User::insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 2,
        'created_at' => Carbon::now()
      ]);
        return back();
    }
}
