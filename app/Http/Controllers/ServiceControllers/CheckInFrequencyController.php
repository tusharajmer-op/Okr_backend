<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CheckInFrequency;
use App\Services\ValidationService;

class CheckInFrequencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $validator;
    public function __construct( ValidationService $validationService)
    {
        $this->validator = $validationService;
    }
    public function index()
    {
        //
        $checkInOptions =  CheckInFrequency::all();
        return response()->json(['message' => 'CheckInFrequency retrieved successfully', 'data' => $checkInOptions], 200);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $checkInFrequency = CheckInFrequency::create($request->all());
        return response()->json(['message' => 'CheckInFrequency created successfully', 'data' => $checkInFrequency], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CheckInFrequency $checkInFrequency)
    {
        //
        $validation = $this->validator->validateRequest($request, [
            'name' => 'required|string',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $checkInFrequency->update($request->all());

        return response()->json(['message' => 'CheckInFrequency updated successfully', 'data' => $checkInFrequency], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckInFrequency $checkInFrequency)
    {
        //
        $checkInFrequency->delete();
        return response()->json(['message' => 'CheckInFrequency deleted successfully'], 204);
    }
}
