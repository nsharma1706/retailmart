<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Menu</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<style>
			.btn1{
				width:20px;
				height:20px;
				border-radius:6px;
				font-weight:bold;
				font-size:16px;
				cursor:pointer;
			}
		</style>
    </head>
    <body class="container">
	<?php
//	print_r($data['checkoutData']);
	?>
        <div class="row">
            <div class="col-md-12">
				<table class="table table-hover">
					<thead>
						<tr class="thead-dark">
							<th class="text-left">Item Name</th>
							<th class="text-center">Quantity</th>						
							<th class="text-center">Unit Price</th>						
							<th class="text-right">Item Price</th>
						</tr>								
					</thead>
					<tbody>
						@foreach ($data['cart'] as $item)
							<tr>
								<td class="text-left"><p>{{ $item->name }}</p></td>
								<td class="text-center"><p>{{ $item->qty }}</p></td>						
								<td class="text-center"><p>{{ $item->price }}</p></td>													
								<td class="text-right"><p>{{ ($item->qty*$item->price) }}</p></div>																														
							</tr>
						@endforeach									
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3" class="text-right">Total</td>
							<td class="text-right">{{ @$data['checkoutData'][0]->total }}</td>							
						</tr>
						<tr>
							<td colspan="3" class="text-right">Discount</td>
							<td class="text-right">{{ @$data['checkoutData'][0]->discamt }}</td>							
						</tr>
						<tr>
							<td colspan="3" class="text-right">Final Total</td>
							<td class="text-right">{{ @$data['checkoutData'][0]->amttopay }}</td>							
						</tr>
						<tr>
							<td colspan="4" class="text-right">------------------------------------------------------</td>
						</tr>						
						<tr>
							<td colspan="3" class="text-right">Pay By Cash (2% Discount)</td>
							<td class="text-right"><button type="button" class="btn btn-success" onclick="pay('cash')">You will pay {{ ($data['checkoutData'][0]->amttopay-$data['checkoutData'][0]->amttopay*2/100) }}</button></td>							
						</tr>
						<tr>
							<td colspan="3" class="text-right">Pay By Credit</td>
							<td class="text-right"><button type="button" class="btn btn-success" onclick="pay('credit')">You will pay {{ $data['checkoutData'][0]->amttopay }}</button></td>							
						</tr>						
					<tfoot>
				</table>
            </div>
        </div>
    </body>
</html>
<script>
$(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});

var pay = function (payType){
	let requestData = {
		payType:payType
	};
	$.ajax({
		url:'payorder',
		type:'POST',
		data:requestData,
		async:false,
		success:function(res){
			alert("Order Paid");
			location.href = "/menu";
		},
		error:function(err){
		}
		
	});
}
</script>
