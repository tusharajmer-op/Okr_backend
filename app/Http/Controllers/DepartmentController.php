<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Services\ValidationService;

class DepartmentController extends Controller
{   private $validator;
    public function __construct(ValidationService $validator)
    {
    $this->validator = $validator;
    }

    //
    public function index()
    {
        $departments = Department::all();
        return response()->json(["message"=>"","data"=>$departments,"status"=>200]);
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'short_name' => 'required',
            'description' => 'required'
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $department = Department::create($request->all());
        return response()->json(["message"=>"Department created successfully","data"=>$department,"status"=>200]);
    }
    public function show($id)
    {
        $department = Department::find($id);
        if(!$department){
            return response()->json(["message"=>"Department not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$department,"status"=>200]);
    }
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        if(!$department){
            return response()->json(["message"=>"Department not found","data"=>[],"status"=>404]);
        }
        $rules = [
            'name' => 'required',
            'short_name' => 'required',
            'description' => 'required'
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $department->update($request->all());
        return response()->json(["message"=>"Department updated successfully","data"=>$department,"status"=>200]);
    }
    public function destroy($id)
    {
        $department = Department::find($id);
        if(!$department){
            return response()->json(["message"=>"Department not found","data"=>[],"status"=>404]);
        }
        $department->delete();
        return response()->json(["message"=>"Department deleted successfully","data"=>[],"status"=>200]);
    }
}
