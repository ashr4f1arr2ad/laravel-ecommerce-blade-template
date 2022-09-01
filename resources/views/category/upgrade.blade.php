@extends('layouts.app')

@section('content')
  <div class="col-6 m-auto">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('category/join/view') }}">Category List</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $category_info->category_name }}</li>
      </ol>
    </nav>
    <div class="card-header">
      <h3>Join Category</h3>
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
      <form action="{{ url('category/upgrade/push') }}" method="post">
        @csrf
        <div class="form-group">
          <label>Category Name</label>
          <input type="hidden" class="form-control" name="category_id" value="{{ $category_info->id }}">
          <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ $category_info->category_name }}">
        </div>
        <button type="submit" class="btn btn-primary">Join Category</button>
      </form>
    </div>
  </div>
@endsection
