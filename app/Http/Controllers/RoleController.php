<?php

namespace App\Http\Controllers;
use App\Models\Roles;
use App\Services\ValidationService;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    private $validator;
    public function __construct(ValidationService $validator)
    {   
        $this->validator = $validator;
    }
    public function index(){
        $roles = Roles::all();
        return response()->json(["message"=>"","data"=>$roles,"status"=>200]);
    }
    public function store(Request $request){
        $rules = [
            'name' => 'required',
            'description' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
        $role = Roles::create($request->all());
        }
        catch(\Exception $e){
            if ($e->getCode() == 23000){
                return response()->json(["message"=>"Role already exists","data"=>[],"status"=>409]);
            }
            
        }
        return response()->json(["message"=>"Role created successfully","data"=>$role,"status"=>200]);
    }
    public function show($id){
        $role = Roles::find($id);
        if(!$role){
            return response()->json(["message"=>"Role not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$role,"status"=>200]);
    }
    public function update(Request $request, $id){
        $role = Roles::find($id);
        if(!$role){
            return response()->json(["message"=>"Role not found","data"=>[],"status"=>404]);
        }
        $rules = [
            'name' => 'required',
            'description' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $role->update($request->all());
        return response()->json(["message"=>"Role updated successfully","data"=>$role,"status"=>200]);
    }
    public function destroy($id){
        $role = Roles::find($id);
        if(!$role){
            return response()->json(["message"=>"Role not found","data"=>[],"status"=>404]);
        }
        $role->delete();
        return response()->json(["message"=>"Role deleted successfully","data"=>[],"status"=>200]);
    }

}
