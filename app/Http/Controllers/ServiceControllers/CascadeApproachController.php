<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CascadeApproach;
use App\Services\ValidationService;

class CascadeApproachController extends Controller
{
    private $validator;
    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cascadeApproaches =  CascadeApproach::all();
        return response()->json(['message' => 'CascadeApproach retrieved successfully', 'data' => $cascadeApproaches], 200);
    }



    public function store(Request $request)
    {
        //
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $cascadeApproach = CascadeApproach::create($request->all());
        return response()->json(['message' => 'CascadeApproach created successfully', 'data' => $cascadeApproach], 201);
    }


    public function update(Request $request, CascadeApproach $cascadeApproach)
    {
        //
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $cascadeApproach->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CascadeApproach $cascadeApproach)
    {
        //
        $cascadeApproach->delete();
        return response()->json(['message' => 'CascadeApproach deleted successfully'], 204);
    }
}
