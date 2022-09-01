@extends('layouts/app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-6 m-auto">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url('product/join/view') }}">Product List</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $product_info->product_name }}</li>
        </ol>
      </nav>
      <div class="card-header">
        <h3>Upgrade Product</h3>
      </div>
      <div class="card-body">
        <form action="{{ url('product/upgrade/push') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Category Name</label>
            <select class="form-control" name="category_id">
              <option value="">*** Select ***</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ ($product_info->category_id==$category->id)?"selected":"" }}>{{ $category->category_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Product Name</label>
            <input type="hidden" name="product_id" class="form-control" value="{{ $product_info->id }}">
            <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{ $product_info->product_name }}">
          </div>
          <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" placeholder="Enter Product Description" name="product_dct">{{ $product_info->product_dct }}</textarea>
          </div>
          <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" value="{{ $product_info->product_price }}">
          </div>
          <div class="form-group">
            <label>Product Quantity</label>
            <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_quantity" value="{{ $product_info->product_quantity }}">
          </div>
          <div class="form-group">
            <label>Quantity Alert</label>
            <input type="text" class="form-control" placeholder="Enter Product Quantity Alert" name="product_quantity_alert" value="{{ $product_info->product_quantity_alert }}">
          </div>
          <div class="form-group">
            <label>Product Image</label>
            <input type="file" class="form-control" name="product_image">
          </div>
          <button type="submit" class="btn btn-primary">Upgrade Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
