<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Cart;

class MenuController extends Controller
{
	public function __construct(){
		
	}
		
	public function listItem(Request $request){
		$data['list'] = Menu::getAllItem();
		$data['cart'] = array();
		if($request->session()->get('ssnorderid') != ""){
			$data['cart'] = Cart::getCartItems($request->session()->get('ssnorderid'));					
		}
		return view('menu',compact('data'));
	}
}
