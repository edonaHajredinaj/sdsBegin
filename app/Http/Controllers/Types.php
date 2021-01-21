<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Http\Requests\TypeRequests\addRequest;
use App\Http\Requests\TypeRequests\deleteRequest;
use App\Http\Requests\TypeRequests\updateRequest;

class Types extends Controller {
    
    public function all() {
        
        return Type::all();
    }

    public function get($id) {

        return Type::findOrFail($id);
    }

    public function store(addRequest $request) {
        
        $types = new Type();

        $types->type = $request->type;
        $types->save();

        return $types;
    }

    public function update(addRequest $request, $id)
    {
        $types = Type::find($id);
       
        if($request->has('type')) {
            $types->type = $request->type;
        }
        $types->update();

        return $types;
    }

    //update method 3: besart - works
    // public function update(Request $request) {

    //     $types = Type::find($request->id);

    //     if($types !== null) {
    //         //$types->update($request->all()); //update() ===== fill()
    //         $types->update($this->validateAttributes()->all());
             
    //         return $types;
    //     } else {
    //         return response()->json("This id could not be found");
    //     }
    // }

    public function delete(deleteRequest $request, $id) {
        Type::findOrFail($id)->delete();

        return 204;
    }

    // protected function validateAttributes() {
    //     return request()->validate
    //     ([
    //         'type' => ['required', 'min:3' , 'max:200']
    //     ]);
    // }
}
