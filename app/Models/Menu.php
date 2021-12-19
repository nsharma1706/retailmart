<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

	public static function getAllItem(){ 
		return DB::table('items')->get()->where('status','=','1');
	}
	
	public static function getItemDetail($id){ 
		return DB::table('items')->select('id', 'name', 'price')->get()->where('id','=',$id);
	}	
}
