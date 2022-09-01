<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('rolechecker');
    }
    function categoryjoinview() {
      $categories = Category::all();
      return view('category/view', compact('categories'));
    }
    function categoryjoinpush(Request $request)
    {
      $request ->validate([
        'category_name' => 'required',
      ],
      [
        'category_name.required' => 'Category Name Needed',
      ]
    );
      Category::insert([
        'category_name' => $request->category_name,
        'created_at' => Carbon::now()
      ]);
      return back()->with('status', 'Category Successfully Added!');
    }
    function categoryerase($category_id) {
        Category::find($category_id)->delete();
        return back();
    }
    function categoryupgrade($category_id) {
      $category_info = Category::findOrFail($category_id);
      return view('category/upgrade', compact('category_info'));
    }
    function categoryupgradepush(Request $request) {
      $request->validate([
        'category_name' => 'required'
      ]);
      Category::find($request->category_id)->update([
        'category_name' => $request->category_name,
      ]);
      return back()->with('status', 'Category Upgrade Successfully');
    }
}
