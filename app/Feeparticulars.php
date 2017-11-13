<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeparticulars extends Model
{
    protected $table = 'particulars';

     public static function getRecordWithSlug($slug)
    {
        return Feeparticulars::where('slug', '=', $slug)->first();
    }

    public static function get($type=1)
    {
    	return Feeparticulars::where('is_income','=',$type)
 							   ->where('status','=',1)
    	                        ->get();
    }

 
}
