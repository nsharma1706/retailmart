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
        <div class="row">
            <div class="col-md-8">
				<table class="table table-hover">
					<tr class="thead-dark">
						<th class="text-left">Item Name</th>
						<th class="text-center">Price</th>
						<th></th>					
					</tr>			
					@foreach ($data['list'] as $item)
						<tr>
							<td class="text-left">{{ $item->name }}</td>
							<td class="text-center">{{ $item->price }}</td>						
							<td class="text-right"><button type="button" class="btn btn-success" onclick="addItemToCart({{ $item->id }})">Add To Cart</button></div>																														
						</tr>
					@endforeach				
				</table>
            </div>
			<div class="col-md-4">
				<h3 class="text-center">Cart</h3>
				<div id="cartSection">
					@include('cart')				
				</div>
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

const addItemToCart = function(id){
	var requestData = {
		itemId : id
	};
	$.ajax({
		url:'addToCart',
		type:'POST',
		data:requestData,
		async:false,
		success:function(res){
			var resData = res;
			if(resData.status == 1){
				$.ajax({
					url:'getCart',
					type:'POST',
					data:requestData,
					async:false,
					success:function(reshtml){
						$("#cartSection").html(reshtml);
						alert(res.msg);
					}
				});				
			}
		},
		error:function(err){
		}
	});
}

const updateQty = function(cartId, mode){
	var cartQty = parseInt($("#cartqty"+cartId).html());
	var newQty = 0;
	if(mode == 0){
		if(cartQty == 0){
			alert("No more quantity to decrease!.");
		} else {
			newQty = cartQty-1;
		}
	} else {
		newQty = cartQty+1;		
	}
	var requestData = {
		cartId : cartId,
		qty : newQty
	}
	$.ajax({
		url:'updateCart',
		type:'POST',
		data:requestData,
		async:false,
		success:function(res){
			var resData = res;
			if(resData.status == 1){
				$.ajax({
					url:'getCart',
					type:'POST',
					data:requestData,
					async:false,
					success:function(reshtml){
						$("#cartSection").html(reshtml);
					}
				});				
			}
		},
		error:function(err){
		}
	});	
}
</script>
