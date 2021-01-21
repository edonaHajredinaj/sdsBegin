<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['product_id', 'quantity'];

    public function products() {

        return $this->hasMany(Product::class, 'product_id');
    }
}
