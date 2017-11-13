<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeDiscount extends Model
{
    protected $table = "feediscounts";

     /**
     * Create a conversation slug.
     *
     * @param  string $title
     * @return string
     */
    // public static function makeSlug($title)
    // {
    //     $slug = str_slug($title);

    //     $count = FeeDiscount::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

    //     return $count ? "{$slug}-{$count}" : $slug;
    // }
}
