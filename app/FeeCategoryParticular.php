<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FeeCategoryParticular extends Model
{
    protected $table='feecategory_particulars';

	public static function getTotalFee($category_id)
	 {
	 	return FeeCategoryParticular::where('feecategory_id', '=', $category_id)->sum('amount');
	 } 
}
