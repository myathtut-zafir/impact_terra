<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    public function market()
    {
        return $this->belongsTo('App\Models\Market');
    }
    public function Product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
