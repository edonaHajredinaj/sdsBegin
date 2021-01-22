<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['type'];

    protected $table = 'types';

    // public function resolveRouteBinding($value)
    // {
    //     return $this->where('id', $value)
    //         ->orWhere('slug', $value)
    //         ->first();
    // }
    
    public function product() {
        
        return $this->hasOne(Product::class, 'type_id');
    }
}
