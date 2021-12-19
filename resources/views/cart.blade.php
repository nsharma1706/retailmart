<table class="table">
	<tr class="thead-light">
		<th class="text-left">Name</th>
		<th class="text-right">Quantity</th>			
	</tr>
	@if(count($data['cart']) >0)
		@foreach ($data['cart'] as $cartitem)
			<tr>
				<td class="text-left">{{ $cartitem->name }}</td>
				<td class="text-right">
					<div class="row">
						<div class="col-md-4">
							<span class="btn1" onclick="updateQty({{ $cartitem->id }},0)">&nbsp;-&nbsp;</span>
						</div>
						<div class="col-md-4">
							<span id="cartqty{{ $cartitem->id }}">{{ $cartitem->qty }}</span>
						</div>
						<div class="col-md-4">
							<span class="btn1" onclick="updateQty({{ $cartitem->id }},1)">&nbsp;+&nbsp;</span>
						</div>									
					</div>
				</td>			
			</tr>	
		@endforeach
		<tr>
			<td colspan="2" class="text-center"><a href="/checkout" class="btn btn-success">Go To Checkout</a></td>
		</tr>
	@else 
		<tr>
			<td colspan="2" class="text-center">Cart Empty</td>
		</tr>			
	@endif
</table>	