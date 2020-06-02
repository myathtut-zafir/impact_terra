<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function productPrice()
    {
        return $this->hasMany('App\Models\ProductPrice');
    }
}
