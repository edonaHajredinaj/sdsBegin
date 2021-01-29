<?php

namespace App;


use App\Product;
use Illuminate\Database\Eloquent\Model;


class SaleProduct extends Model {
    protected $table = 'saleproduct';

    protected $fillable = ['product_id', 'quantity'];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
    
}
