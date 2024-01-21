<?php

namespace App\Http\Controllers\Objectives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Objects;
use App\Services\ValidationService;
use App\Services\ObjectsServices;
class ObjectController extends Controller
{
    //
    protected $validator;
    protected $objectService;
    public function __construct(ValidationService  $validator,ObjectsServices $objectService)
    {
        $this->validator = $validator;
        $this->objectService = $objectService;
    }
    
    public function index(Request $request)
    {
        $objectives = $this->objectService->showobjects();
        return response()->json($objectives);
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'time_period' => 'required',
            'is_private' => 'required',
            'visibility' => 'required|in:myself,department,accesslist',
            'tags' => 'required',
            'category'=>'required',
            'department'=>'required',
           
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
            $objective = $this->objectService->storeObjects($request);
            return response()->json($objective);
        }
        catch(\Exception $e){

            return response()->json(['message'=> $e,'data'=>[],'status'=>500]);
        }
    }
    public function show($id)
    {
        $objective = Objects::find($id);
        if(!$objective){
            return response()->json(["message"=>"Object not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$objective,"status"=>200]);
    }
    public function destroy($id)
    {
        $object = $this->objectService->deleteObject($id);
        return response()->json($object);
    }
    public function showMyObjects(Request $request)
    {
        $objectives = $this->objectService->showMyokrs($request);
        return response()->json($objectives);
    }
    public function showDepartmentObjects(Request $request)
    {
        $objectives = $this->objectService->showMyDepartmentOkrs($request);
        return response()->json($objectives);
    }
}
