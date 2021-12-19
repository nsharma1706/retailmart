<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Checkout;

class CheckoutController extends Controller
{
	public function checkout(Request $request){
		$ssnorderid = $request->session()->get('ssnorderid');
		$data['cart'] = Cart::getCartItems($ssnorderid);	
		$total = 0;
		$discamt = 0;
		$amttopay = 0;
		$freeItemAdded = 0;
		foreach($data['cart'] as $cartItem){
			$total += $cartItem->qty*$cartItem->price;
			if($cartItem->isfree == 1){
				$freeItemAdded = 1;
			}
		}
		
		if($total > 1000){
			$discamt = $total*10/100;
			if($freeItemAdded == 0){
				$this->addFreeItem($ssnorderid,5);				
				$data['cart'] = Cart::getCartItems($ssnorderid);							
			}
		} else if($total > 500){
			$discamt = $total*10/100;			
		} else {
			$discamt = 0;						
		}
		if($freeItemAdded == 1 && $total <= 1000){
			Checkout::removeFreeItem($ssnorderid);
			$data['cart'] = Cart::getCartItems($ssnorderid);	
		}		

		$amttopay = $total-$discamt;
		$checkDataArray['ssnorderid'] = $ssnorderid;	
		$checkDataArray['orderid'] = 0;
		$checkDataArray['total'] = $total;
		$checkDataArray['discamt'] = $discamt;
		$checkDataArray['amttopay'] = $amttopay;		
 		Checkout::updateCheckout([$checkDataArray], ['ssnorderid'], ['total','discamt','amttopay']);
		$data['checkoutData'] = Checkout::orderData($ssnorderid);
		return view('checkout',compact('data'));		
	}
	
	public function addFreeItem($ssnorderid,$itemId){
		$itemDetail = Menu::getItemDetail($itemId);
		$itemData = array_values($itemDetail->toArray())[0];		
		$requestArr['orderid'] = 0;
		$requestArr['itemid'] = $itemData->id;
		$requestArr['name'] = $itemData->name;			
		$requestArr['price'] = 0;
		$requestArr['qty'] = 1;		
		$requestArr['isfree'] = '1';				
		$requestArr['ssnorderid'] = $ssnorderid;
		Cart::addToCart($requestArr);
	}		
	
	public static function payOrder(Request $request){
		$payType = $request->payType;
		$ssnorderid = $request->session()->get('ssnorderid');
		$checkData = Checkout::orderData($ssnorderid);		
		$total = $checkData[0]->total;
		$discamt = $checkData[0]->discamt;
		
		$amttopay = $total-$discamt;
		$cashdisc = 0;
		$paytype = '0';
		if($payType == "cash"){
			$cashdisc = $amttopay*2/100;
			$amttopay -= $cashdisc; 
			$paytype = '1';
		} else {
			$paytype = '2';
		}
		$checkDataArray['ssnorderid'] = $ssnorderid;	
		$checkDataArray['amttopay'] = $amttopay;		
		$checkDataArray['cashdisc'] = $cashdisc;
		$checkDataArray['paytype'] = $paytype;	
		$checkDataArray['paidstatus'] = '1';					
		$checkDataArray['orderid'] = Checkout::genOrderId();
		Checkout::updateCheckout([$checkDataArray], ['ssnorderid'], ['orderid','paytype','paidstatus','cashdisc','amttopay']);					
		$request->session()->forget('ssnorderid');
	}
}
