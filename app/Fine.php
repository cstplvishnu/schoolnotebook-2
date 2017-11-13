<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $table = 'fines';
    
    public function feeCategory()
    {
    	return $this->belongsTo('App\FeeCategory');
    }


    // /**
    //  * Create a conversation slug.
    //  *
    //  * @param  string $title
    //  * @return string
    //  */
    // public static function makeSlug($title)
    // {
    //     $slug = str_slug($title);

    //     $count = Fine::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

    //     return $count ? "{$slug}-{$count}" : $slug;
    // }

}
