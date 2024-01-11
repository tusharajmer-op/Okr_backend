<?php

namespace App\Http\Controllers;
use App\Models\Jobs;
use App\Services\ValidationService;

use Illuminate\Http\Request;

class JobController extends Controller
{
    //
    private $validator;
    public function __construct(ValidationService $validator)
    {   
        $this->validator = $validator;
    }
    public function index(){
        $jobs = Jobs::all();
        return response()->json(["message"=>"","data"=>$jobs,"status"=>200]);
    }
    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'short_name' => 'required',
            'description' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
        $job = Jobs::create($request->all());}
        catch(\Exception $e){
            if ($e->getCode() == 23000){
                return response()->json(["message"=>"Job already exists","data"=>[],"status"=>409]);
            }
            
        }
        return response()->json(["message"=>"Job created successfully","data"=>$job,"status"=>200]);
    }
    public function show($id){
        $job = Jobs::find($id);
        if(!$job){
            return response()->json(["message"=>"Job not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$job,"status"=>200]);
    }
    public function update(Request $request, $id){
        $job = Jobs::find($id);
        if(!$job){
            return response()->json(["message"=>"Job not found","data"=>[],"status"=>404]);
        }
        $rules = [
            'name' => 'required',
            'short_name' => 'required',
            'description' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $job->update($request->all());
        return response()->json(["message"=>"Job updated successfully","data"=>$job,"status"=>200]);
    }
    public function destroy($id){
        $job = Jobs::find($id);
        if(!$job){
            return response()->json(["message"=>"Job not found","data"=>[],"status"=>404]);
        }
        $job->delete();
        return response()->json(["message"=>"Job deleted successfully","data"=>[],"status"=>200]);
    }
}
