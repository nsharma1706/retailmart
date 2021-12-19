<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

	public static function getCartItems($ssnorderid){ 
		return DB::table('cart')->get()->sortBy('id')->where('ssnorderid',$ssnorderid);
	}
	
	public static function addToCart($requestData){
		DB::table('cart')->insert($requestData);		
	}
	
	public static function updateCart($id, $qty){
		DB::table('cart')->where('id', $id)->update(['qty' => $qty]);		
	}
	
	public static function deleteCart($id){
		DB::table('cart')->where('id', '=', $id)->delete();
	}
}
