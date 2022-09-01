@extends('layouts.frontend')

@section('main_content')
  <!-- Page -->
  	<div class="page-area cart-page spad">
  		<div class="container">
        <form action="{{ url('update/cart') }}" method="post">
          @csrf
  			<div class="cart-table">
  				<table>
  					<thead>
  						<tr>
  							<th class="product-th">Product</th>
  							<th>Price</th>
  							<th>Quantity</th>
  							<th class="total-th">Total</th>
  						</tr>
  					</thead>
  					<tbody>
              @php
                $sub_total = 0;
              @endphp
              @forelse ($cart_items as $cart_item)
  						<tr>
  							<td class="product-col">
  								<img src="{{ asset('uploads_file/product_image') }}/{{ $cart_item->productRelation->product_image }}" alt="Data Not Found" width="100">
  								<div class="pc-title">
  									<h4>{{ $cart_item->productRelation->product_name }}</h4>
  									<a href="{{ url('single/cart/delete') }}/{{ $cart_item->id }}">Delete Selected</a>
  								</div>
  							</td>
  							<td class="price-col">${{ $cart_item->productRelation->product_price }}</td>
  							<td class="quy-col">
                  <input type="hidden" name="product_id[]" value="{{ $cart_item->product_id }}">
  								<div class="quy-input">
  									<span>Qty</span>
  									<input type="number" name="user_quantity[]" value="{{ $cart_item->product_quantity }}">
  								</div>
  							</td>
  							<td class="total-col">
                  ${{ $cart_item->productRelation->product_price*$cart_item->product_quantity }}
                  @php
                    $sub_total = $sub_total + ($cart_item->productRelation->product_price*$cart_item->product_quantity)
                  @endphp
                </td>
              </tr>
            @empty
              <tr class="text-center">
                <td colspan="4">No Product Selected</td>
              </tr>
            @endforelse
  					</tbody>
  				</table>
  			</div>
  			<div class="row cart-buttons">
  				<div class="col-lg-5 col-md-5">
  					<a href="{{ url('/') }}" class="site-btn btn-continue">Continue shooping</a>
  				</div>
  				<div class="col-lg-7 col-md-7 text-lg-right text-left">
  					<a href="{{ url('erase/cart') }}" class="site-btn btn-clear">Clear cart</a>
  					<button type="submit" class="site-btn btn-line btn-update">Update Cart</button>
  				</div>
  			</div>
        </form>
  		</div>
  		<div class="card-warp">
  			<div class="container">
  				<div class="row">
  					<div class="col-lg-4">
  						<div class="shipping-info">
  							<h4>Shipping method</h4>
  							<p>Select the one you want</p>
  							<div class="shipping-chooes">
  								<div class="sc-item">
  									<input type="radio" name="sc" id="one">
  									<label for="one" id="instant_delivery">Next day delivery<span>$4.99</span></label>
  								</div>
  								<div class="sc-item">
  									<input type="radio" name="sc" id="two">
  									<label for="two" id="standard_delivery">Standard delivery<span>$1.99</span></label>
  								</div>
  								<div class="sc-item">
  									<input type="radio" name="sc" id="three">
  									<label for="three" id="free_of_charge">Personal Pickup<span>Free</span></label>
  								</div>
  							</div>
  							<h4>Cupon code</h4>
  							<p>Enter your cupone code</p>
  							<div class="cupon-input">
  								<input type="text" id="user_insert_id" value="{{ $coupon_name}}">
  								<button class="site-btn" id="apply_coupon">Apply</button>
  							</div>
  						</div>
  					</div>
  					<div class="offset-lg-2 col-lg-6">
  						<div class="cart-total-details">
  							<h4>Cart total</h4>
  							<p>Final Info</p>
  							<ul class="cart-total-card">
  								<li>Subtotal<span>${{ $sub_total }}</span></li>
  								<li>Discount Amount<span>{{ $coupon_discount_amount }}%</span></li>
  								<li>Shipping<span id="shipping_charge">0</span><span>$</span></li>
  								<li class="total">Total<span id="grand_total">{{ $sub_total-($sub_total*($coupon_discount_amount/100)) }}</span><span>$</span></li>
  							</ul>
  							<a class="site-btn btn-full" href="checkout.html">Proceed to checkout</a>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- Page end -->
    @section('footer_js')
      <script>
      	$(document).ready(function(){
      		var apply_coupon_btn = $('#apply_coupon');
          $(apply_coupon_btn).click(function(){
            var coupon_name = $('#user_insert_id').val();
            window.location.href = "{{ url('/cart') }}"+"/"+coupon_name;
          });
      		var instant_delivery = $('#instant_delivery');
          $(instant_delivery).click(function(){
            var instant_delivery_charge = parseFloat(4.99);
            $('#shipping_charge').html(instant_delivery_charge);
            var grand_total = parseFloat($('#grand_total').html());
            var final_grand_total = grand_total + instant_delivery_charge;
            $('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
          });
      		var standard_delivery = $('#standard_delivery');
          $(standard_delivery).click(function(){
            var standard_delivery_charge = parseFloat(1.99);
            $('#shipping_charge').html(standard_delivery_charge);
            var grand_total = parseFloat($('#grand_total').html());
            var final_grand_total = grand_total + standard_delivery_charge;
            $('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
          });
      		var free_of_charge = $('#free_of_charge');
          $(free_of_charge).click(function(){
            var free_of_charge_amount = parseFloat(0);
            $('#shipping_charge').html(free_of_charge_amount);
            var grand_total = parseFloat($('#grand_total').html());
            var final_grand_total = grand_total + free_of_charge_amount;
            $('#grand_total').html(parseFloat(final_grand_total).toFixed(2));
          });
      	});
      </script>
    @endsection
@endsection
