<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function category(){
        return $this->belongsTo(Category::class);
    }

    function brand(){
        return $this->belongsTo(Brand::class);
    }


}
