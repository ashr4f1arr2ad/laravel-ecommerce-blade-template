@extends('layouts.app')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6">
        <table class="table table-bordered bg-light border-primary">
          <tr class="table-primary">
            <td>Coupon Name</td>
            <td>Discount Amount</td>
            <td>Valid Till</td>
            <td>Status</td>
          </tr>
          @forelse ($coupons as $coupon)
            <tr>
              <td>{{ $coupon->coupon_name }}</td>
              <td>{{ $coupon->discount_amount }}</td>
              <td>{{ $coupon->valid_till }}</td>
              <td>
                @if (Carbon\Carbon::now()->format('Y-m-d') <= $coupon->valid_till)
                  <div class="bg-dark text-center py-1 text-white">
                    Valid
                  </div>
                  @else
                    <div class="bg-danger text-center py-1 text-white">
                      Invalid
                    </div>
                @endif
              </td>
            </tr>
          @empty
            <tr class="text-center">
              <td colspan="3">No Data Available</td>
            </tr>
          @endforelse
        </table>
      </div>
      <div class="col-6">
        <div class="card-header">
          <h3>Join Coupon</h3>
        </div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-danger">
              {{ session('status') }}
          </div>
        @endif
          @if ($errors->all())
          <div class="alert alert-success">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </div>
        @endif
          <form action="{{ url('coupon/join/push') }}" method="post">
            @csrf
            <div class="form-group">
              <label>Catego ry Name</label>
              <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name">
            </div>
            <div class="form-group">
              <label>Discount Amount(%)</label>
              <input type="text" class="form-control" placeholder="Enter Discount Amount" name="discount_amount">
            </div>
            <div class="form-group">
              <label>Valid Till</label>
              <input type="date" class="form-control" name="valid_till">
            </div>
            <button type="submit" class="btn btn-primary">Join Coupon</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
