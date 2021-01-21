<?php

namespace App;

use App\Sale;
use App\Type;
use App\Stock;
use App\SaleProduct;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'type_id', 'price'];

    public function type() {

        return $this->belongsTo(Type::class, 'type_id');
    }

    public function sales() {

        return $this->belongsToMany(SaleProduct::class, 'product_id');
    }

    public function stock() {
        return $this->belongsTo(Stock::class, 'quantity');
    }

}
