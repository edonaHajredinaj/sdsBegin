<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Http\Requests\ProductRequests\addRequest;
use App\Http\Requests\ProductRequests\getRequest;
use App\Http\Requests\ProductRequests\deleteRequest;
use App\Http\Requests\ProductRequests\updateRequest;

class Products extends Controller
{
    public function all() {
        return Product::all();
    }

    public function get(getRequest $request, $id) {
        return Product::findOrFail($request->input('id'));
    }

    public function store(addRequest $request) {

        $product = new Product();

        $product->name = $request->name;
        $product->type_id = $request->type_id;
        $product->price = $request->price;

        $product->save();

        return json_encode($product);
        //return $product;
        //return response()->json("The product was saved as: ". $request->input('name') . " with the id of: $product->id " );
    }

    public function update(updateRequest $request) {

        $product = Product::findOrFail($request->input('id'));

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

        //return responseJson(Response::HTTP_OK, $product);
        return json_encode($product);
    }    

    public function delete(deleteRequest $request) 
    {
        Product::findOrFail($request->input('id'))->delete();
           
        return response()->json("The product with the id of: " . $request->input('id') . " was deleted.");
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
