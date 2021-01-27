<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequests\addRequest;

class Products extends Controller
{
    public function all() {
        return Product::all();
    }

    public function get($id) {
        return Product::findOrFail($id);
    }

    public function store(addRequest $request) {

        $product = new Product();

        $product->name = $request->name;
        $product->type_id = $request->type_id;
        $product->price = $request->price;

        $product->save($this->validateAttributes());

        return $product;
    }

    public function update(addRequest $request, $id) {

        $product = Product::find($id);

        if($request->has('name')) {
            $product->name = $request->name;
        }
        if($request->has('type_id')) {
            $product->type_id = $request->type_id;
        }
        if($request->has('price')) {
            $product->price = $request->price;
        }

        $product->update();

        return $product;
    }    

    public function delete(deleteRequest $request) {

        // $request->validate
        //([
               //'id' => 'required |max:50|exists:'.(new Product)->getTable().',id,deleted_at,NULL'
        // ]); 

        Product::findOrFail($id)->delete();
        
        return response()->json("The product with the id of: $id was deleted.");
    }

    // protected function validateAttributes() {
    //    return request()->validate(
    //     [
    //         'name' => ['required', 'min:3', 'max:255'],
    //         'type_id' => 'required|numeric',
    //         'price' => 'required|numeric',
    //     ]);
    // }
}
