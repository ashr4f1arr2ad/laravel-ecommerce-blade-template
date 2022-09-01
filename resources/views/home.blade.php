@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered bg-light border-primary">
                      <tr class="table-primary">
                        <td>Name</td>
                        <td>Email</td>
                        <td>Created Date</td>
                      </tr>
                      @foreach ($data_users as $data_user)
                      <tr>
                        <td>{{ $data_user->name }}</td>
                        <td>{{ $data_user->email }}</td>
                        <td>{{ $data_user->created_at }}</td>
                      </tr>
                      @endforeach
                    </table>
                    {{ $data_users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
