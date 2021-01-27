<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Http\Requests\TypeRequests\addRequest;
use App\Http\Requests\TypeRequests\getRequest;
use App\Http\Requests\TypeRequests\deleteRequest;
use App\Http\Requests\TypeRequests\updateRequest;


class Types extends Controller {
    
    public function all() {
        
        return Type::all();
    }

    public function get(getRequest $request, $id) {

        return Type::findOrFail($request->input('id'));
    }

    public function store(addRequest $request) {
        
        $types = new Type();

        $types->type = $request->type;
        $types->save();

        //return $types;
        return response()->json("Type was saved as $types ");
    }//ok

    public function update(updateRequest $request)
    {
        $types = Type::find($request->input('id'));
       
        if($request->has('type')) {
            $types->type = $request->type;
        }
        $types->update();

        return json_encode($types);
        //return $types;
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

    //replace Request parameter with deleteRequest
    //in deleteRequest, find a way to validate $id route
    public function delete(deleteRequest $request) {
    
        Type::findOrFail($request->input('id'))->delete();

        //return 204;
        return response()->json("The type with the id of: " .$request->input('id')." was deleted.");
    }

    // protected function validateAttributes() {
    //     return request()->validate
    //     ([
    //         'type' => ['required', 'min:3' , 'max:200']
    //     ]);
    // }
}
