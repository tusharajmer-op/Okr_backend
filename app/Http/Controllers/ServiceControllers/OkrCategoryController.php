<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OkrCategory;
use App\Services\ValidationService;

class OkrCategoryController extends Controller
{
    //
    private $validator;
    public function __construct(ValidationService $validator)
    {   
        $this->validator = $validator;
    }
    public function index(){
        $okrCategories = OkrCategory::all();
        return response()->json(["message"=>"","data"=>$okrCategories,"status"=>200]);
    }
    public function store(Request $request){
        $rules = [
            'category' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
        $okrCategory = OkrCategory::create($request->all());}
        catch(\Exception $e){
            if ($e->getCode() == 23000){
                return response()->json(["message"=>"OkrCategory already exists","data"=>[],"status"=>409]);
            }
            
        }
        return response()->json(["message"=>"OkrCategory created successfully","data"=>$okrCategory,"status"=>200]);
    }
    public function show($id){
        $okrCategory = OkrCategory::find($id);
        if(!$okrCategory){
            return response()->json(["message"=>"OkrCategory not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$okrCategory,"status"=>200]);
    }
    public function update(Request $request, $id){
        $okrCategory = OkrCategory::find($id);
        if(!$okrCategory){
            return response()->json(["message"=>"OkrCategory not found","data"=>[],"status"=>404]);
        }
        $rules = [
            'category' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
        $okrCategory->update($request->all());
        return response()->json(["message"=>"OkrCategory updated successfully","data"=>$okrCategory,"status"=>200]);
    }
        catch(\Exception $e){
            if ($e->getCode() == 23000){
                return response()->json(["message"=>"OkrCategory already exists","data"=>[],"status"=>409]);
            }
            
        }
    
}
public function destroy($id){
    $okrCategory = OkrCategory::find($id);
    if(!$okrCategory){
        return response()->json(["message"=>"OkrCategory not found","data"=>[],"status"=>404]);
    }
    $okrCategory->delete();
    return response()->json(["message"=>"OkrCategory deleted successfully","data"=>[],"status"=>200]);
}
}
