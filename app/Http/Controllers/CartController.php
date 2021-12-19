<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;

class CartController extends Controller
{
	public function getCartItems(Request $request){
		$data['cart'] = Cart::getCartItems($request->session()->get('ssnorderid'));		
		return view('cart',compact('data'));		
	}
	
	public function addToCart(Request $request){
		$requestData = $request->all();
		$itemDetail = Menu::getItemDetail($requestData['itemId']);
		$status = 0;
		$msg = "";

		if(count($itemDetail)>0){			
			$itemData = array_values($itemDetail->toArray())[0];		
			$requestArr['orderid'] = 0;
			$requestArr['itemid'] = $itemData->id;
			$requestArr['name'] = $itemData->name;			
			$requestArr['price'] = $itemData->price;
			$requestArr['qty'] = 1;			
			if (!$request->session()->has('ssnorderid')) {
				$request->session()->put('ssnorderid',(string) Str::uuid());
			}			
			$requestArr['ssnorderid'] = $request->session()->get('ssnorderid');
			Cart::addToCart($requestArr);
			$status = 1;
			$msg = "Item Added To Cart!.";
		} else {
			$msg = "Item Does Not Exists!.";			
		}
		return response()->json(['status' => $status,'msg' => $msg]);
	}
	
	public function updateCart(Request $request){
		$requestData = $request->all();
		$cartId = $requestData['cartId'];
		$qty = $requestData['qty'];
		$ssnorderid = $request->session()->get('ssnorderid');
		if($qty == 0){
			Cart::deleteCart($cartId);			
		} else {
			Cart::updateCart($cartId,$qty);						
		}
		return response()->json(['status' => 1,'msg' => ""]);		
	}	
}
