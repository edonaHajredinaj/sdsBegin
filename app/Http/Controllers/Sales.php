<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Product;
use App\SaleProduct;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequests\getRequest;
use App\Http\Requests\SaleRequests\saveRequest;
use App\Http\Requests\SaleRequests\updateRequest;
use App\Http\Requests\SaleRequests\destroyRequest;

class Sales extends Controller {

    public function all() 
    {
        return SaleProduct::all();
    }

    public function get(getRequest $request, $id) 
    {
        return SaleProduct::findOrFail($request->input('id'));
    }

    public function store(saveRequest $request) 
    {
        $saleProduct = new SaleProduct();
        $saleProduct->product_id = $request->product_id;
        $saleProduct->quantity = $request->quantity;
         
        $saleProduct->save();

        $stock = Stock::where('product_id', $request->product_id)->first();
        $stock->decrement('quantity', $request->quantity);
        $stock->save();

        return json_encode($saleProduct);
    }

    public function update(updateRequest $request) 
    {
        $saleProduct = SaleProduct::find($request->input('id'));
        $stock = Stock::where('product_id', $request->product_id)->first();
        $startingQuantity = (double)$saleProduct->quantity;
        $requestQuantity = (double)$request->quantity;
        
        if($startingQuantity < $request->quantity) {
            $difference = $requestQuantity - $startingQuantity;
            $stock->decrement('quantity', $difference);
        }
        if($startingQuantity > $request->quantity) {
            $difference = $startingQuantity - $requestQuantity;
            $stock->increment('quantity', $difference);
        }
        if($startingQuantity == 0) {
            $stock->quantity = decrement('quantity', $request->quantity);
        }
        
		if($request->has('product_id')) {
            $saleProduct->product_id = $request->product_id;
        }
        if($request->has('quantity')) {
            $saleProduct->quantity = $request->quantity;
        }

        $saleProduct->update();

        
        // $saleProduct->quantity = $product['quantity'];
	    //$saleProduct->save();
       	// $stock = Stock::where('product_id', $product['id'])->get()->first();
       	// $stock->quantity = $stock->quantity + $startingQuantity - $product['quantity'];
       	$stock->update();

	    return json_encode($saleProduct);
    }

    //po fshihet ne 'sale_products' tabelen po nuk po rritet quantity ne 'stocks'.
    public function delete(destroyRequest $request) 
    {

        $saleProduct = SaleProduct::find($request->input('id'));
        
        //me kthy produktin nstock kur tfshihet sale
        $stock = Stock::where('product_id', $saleProduct->product_id)->first();
        $stock->quantity = $stock->quantity + (double)$saleProduct->quantity;
        //dd($saleProduct->quantity);
        //$stock->increment('quantity', $saleProduct->quantity);
       
        $saleProduct->delete();
        $saleProduct->update();
    	return response()->json("The bill was deleted.");
    }

    // public double totalPrice(int quantity, double price) {

    // $sale->total_price = $sale->quantity * $product->price;
    //return $sale;

    //     $quantitySale = $sale->quantity;
    //     $priceProduct = $product->price;
    //     $quantitySale * $priceProduct;

    //     return (quantity * price);  //java
    // }
}
