<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use App\Models\keyTypes;
use Illuminate\Http\Request;
use App\Services\ValidationService;
class KeyTypesController extends Controller
{
    //
    private $validator;
    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }
    public function index()
    {
        return keyTypes::all();
    }
    public function store(Request $request)
    {
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $keyType = keyTypes::create($request->all());
        return response()->json($keyType, 201);
    }
    public function destroy($id)
    {
        $keyType = keyTypes::find($id);
        $keyType->delete();
        return response()->json(null, 204);
    }
    public function update(Request $request, $id)
    {
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $keyType = keyTypes::find($id);
        $keyType->update($request->all());
        return response()->json($keyType, 200);
    }
}
