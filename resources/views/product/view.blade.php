@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      <table class="table table-bordered bg-light border-primary">
        <tr class="table-primary">
          <td>Name</td>
          <td>Category Name</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Quantity Alert</td>
          <td>Product Image</td>
          <td>Option</td>
        </tr>
        @forelse ($products as $product)
        <tr>
          <td>{{ $product->product_name }}</td>
          {{-- <td>{{ App\Category::find($product->category_id)->category_name }}</td> --}}
          <td>{{ $product->categoryRelation->category_name }}</td>
          <td>{{ $product->product_price }}</td>
          <td>{{ $product->product_quantity }}</td>
          <td>{{ $product->product_quantity_alert }}</td>
          <td>
            <img src="{{ asset('uploads_file/product_image') }}/{{ $product->product_image }}" alt="Not Found" width="100">
          </td>
          <td>
            <a href="{{ url('product/upgrade') }}/{{ $product->id }}" class="btn btn-success">Edit</a>
            <a href="{{ url('product/erase') }}/{{ $product->id }}" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      @empty
        <tr class="text-center">
          <td colspan="5">Data Not Found</td>
        </tr>
      @endforelse
      </table>
    </div>
    <div class="col-4">
      <div class="card-header">
        <h3>Join Product</h3>
      </div>
      <div class="card-body">
        @if($errors->all())
        <div class="alert alert-danger">
          <ul style="margin: 0">
          @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if(session()->has('status'))
          <div class="alert alert-success">
              {{ session()->get('status') }}
          </div>
      @endif
        <form action="{{ url('product/join/push') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label>Category Name</label>
            <select class="form-control" name="category_id">
              <option value="">***Select****</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{ old('product_name') }}">
          </div>
          <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" placeholder="Enter Product Description" name="product_dct">{{ old('product_dct') }}</textarea>
          </div>
          <div class="form-group">
            <label>Product Price</label>
            <input type="text" class="form-control" placeholder="Enter Product Price" name="product_price" value="{{ old('product_price') }}">
          </div>
          <div class="form-group">
            <label>Product Quantity</label>
            <input type="text" class="form-control" placeholder="Enter Product Quantity" name="product_quantity" value="{{ old('product_quantity') }}">
          </div>
          <div class="form-group">
            <label>Quantity Alert</label>
            <input type="text" class="form-control" placeholder="Enter Product Quantity Alert" name="product_quantity_alert" value="{{ old('product_quantity_alert') }}">
          </div>
          <div class="form-group">
            <label>Product Image</label>
            <input type="file" class="form-control" name="product_image">
          </div>
          <button type="submit" class="btn btn-primary">Join Product</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
