<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

class Stocks extends Controller
{
    public function all() {

        return Stock::all();
    }

    public function get($id) {

        return Stock::findOrFail($id);
    }

    public function store(Request $request) {
        $stock = new Stock;

        $stock->product_id = $request->product_id;
        $stock->quantity = $request->quantity;

        $stock->save();

        return $stock;
    }


    public function update(Request $request, $id) {
        $stock = Stock::find($id);

        if($request->has('product_id')) {
            $stock->product_id = $request->product_id;
        }
    
        if($request->has('quantity')) {
            $stock->quantity = $request->quantity;
        }
        
        $stock->update();

        return $stock;
    }
    
//     public function update(Request $request){

//         $stock = Stock::find($request->id);

//         if ($stock !== null) {

//             $stock ->fill($request->all());
//             $stock->save();

//             return $stock;
//         } else {
//             return response()->json("This id could not be found");
//         }
// }

    // public function update(Request $request, $id) {
    //     $stock = Stock::findOrFail($id);

    //     $stock->update($request->all());

    //     return $stock;
    // }

    public function delete(Request $request, $id) {
        
        Stock::find($id)->delete();
        
        return response()->json("The stock was deleted.");
    }
}
