<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Checkout extends Model
{
    use HasFactory;

	public static function updateCheckout($checkDataArray,$uniqueArr,$updateItems){
		DB::table('orders')->upsert($checkDataArray, $uniqueArr , $updateItems);		
	}
	
	public static function orderData($ssnorderid){
		return DB::table('orders')->select('total','discamt','amttopay')->where('ssnorderid',$ssnorderid)->get();		
	}
	
	public static function removeFreeItem($ssnorderid){
		DB::table('cart')->where('ssnorderid', '=', $ssnorderid)->where('isfree', '=', '1')->delete();		
	}
	
	public static function genOrderId(){
		return DB::table('orderidgen')->insertGetId(array());		
	}
}
