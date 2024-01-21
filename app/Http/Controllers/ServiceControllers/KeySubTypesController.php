<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\keySubTypes;
use App\Services\ValidationService;

class KeySubTypesController extends Controller
{
    //
    private $validator;
    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }
    public function index()
    {
        return keySubTypes::all();
    }
    public function store(Request $request)
    {
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
            'keytype_id' => 'required|integer',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $keySubType = keySubTypes::create($request->all());
        return response()->json($keySubType, 201);
    }
    public function destroy($id)
    {
        $keySubType = keySubTypes::find($id);
        $keySubType->delete();
        return response()->json(null, 204);
    }
    public function update(Request $request, $id)
    {
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
            'keytype_id' => 'required|integer',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $keySubType = keySubTypes::find($id);
        $keySubType->update($request->all());
        return response()->json($keySubType, 200);
    }
    
}
