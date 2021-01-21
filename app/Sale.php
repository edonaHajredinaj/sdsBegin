<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model 
{
    protected $fillable = ['total_price'];

    public function product() {
        
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }


}
