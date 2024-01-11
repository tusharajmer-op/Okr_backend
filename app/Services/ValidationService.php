<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ValidationService
{   /**
    * Global validator for request validations
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  array  $rules
    *
    * @return array
    */
    public function validateRequest(Request $request, array $rules)
    {
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ["message"=>$validator->errors(),"data"=>[],"status"=>422];
        }

        return ["message"=>"","data"=>[],"status"=>200]; 
    }
    
}
