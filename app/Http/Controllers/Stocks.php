<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\StockRequests\getRequest;
use App\Http\Requests\StockRequests\saveRequest;
use App\Http\Requests\StockRequests\updateRequest;
use App\Http\Requests\StockRequests\destroyRequest;

class Stocks extends Controller
{
    public function all() {

        return Stock::all();
    }

    public function get(getRequest $request, $id) {
        
        // $product = Product::where('id', $stock->product_id);
        return Stock::findOrFail($request->input('id'));
    }
    // public function showCategories($id)    {       
    //      $category_name = Categories::find($id);        
    //      $products = Product::where('status', 1)->where('category', $category_name->name)->orderBy('created_at', 'desc')->paginate(6);        
    //      $categories = Categories::all();        
    //      $product_images = ProductImage::select('id', 'path', 'product_id')->groupBy('product_id')->orderBy('created_at', 'desc')->get();        
    //     return view('category_products', compact('products', 'product_images', 'categories', 'category_name'));    
    //}

    public function store(saveRequest $request) {
        $stock = new Stock;

        $stock->product_id = $request->product_id;
        $stock->quantity = $request->quantity;

        $stock->save();

        return json_encode($stock);
    }

    public function update(updateRequest $request) {
        $stock = Stock::findOrFail($request->input('id'));

        if($request->has('product_id')) {
            $stock->product_id = $request->product_id;
        }
    
        if($request->has('quantity')) {
            $stock->quantity = $request->quantity;
        }
        
        $stock->update();

        return json_encode($stock);
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

    public function delete(destroyRequest $request) {
        
        Stock::findOrFail($request->input('id'))->delete();
        
        return response()->json("The stock with id of: ". $request->input('id') ." was deleted.");
    }
}
