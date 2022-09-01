@extends('layouts.app')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6">
        <table class="table table-bordered bg-light border-primary">
          <tr class="table-primary">
            <td>Sl no</td>
            <td>Category Name</td>
            <td>Created At</td>
            <td>Option</td>
          </tr>
          @forelse ($categories as $category)
          <tr>
            <td>#</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ $category->created_at->diffForHumans() }}</td>
            <td>
              <a href="{{ url('category/upgrade') }}/{{ $category->id }}" class="btn btn-success">Edit</a>
              <a href="{{ url('category/erase') }}/{{ $category->id }}" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        @empty
          <tr class="text-center">
            <td colspan="4">No Data Available</td>
          </tr>
          @endforelse
        </table>
      </div>
      <div class="col-6">
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
          <form action="{{ url('category/join/push') }}" method="post">
            @csrf
            <div class="form-group">
              <label>Category Name</label>
              <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ old('category_name') }}">
            </div>
            <button type="submit" class="btn btn-primary">Join Category</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
