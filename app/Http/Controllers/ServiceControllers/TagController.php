<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;
use App\Services\ValidationService;

class TagController extends Controller
{
    //
    private $validator;
    public function __construct(ValidationService $validator)
    {   
        $this->validator = $validator;
    }
    public function index(){
        $tags = Tags::all();
        return response()->json(["message"=>"","data"=>$tags,"status"=>200]);
    }
    public function store(Request $request){
        $rules = [
            'tag' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
        $tag = Tags::create($request->all());}
        catch(\Exception $e){
            if ($e->getCode() == 23000){
                return response()->json(["message"=>"Tag already exists","data"=>[],"status"=>409]);
            }
            
        }
        return response()->json(["message"=>"Tag created successfully","data"=>$tag,"status"=>200]);
    }
    public function show($id){
        $tag = Tags::find($id);
        if(!$tag){
            return response()->json(["message"=>"Tag not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$tag,"status"=>200]);
    }
    public function update(Request $request, $id){
        $tag = Tags::find($id);
        if(!$tag){
            return response()->json(["message"=>"Tag not found","data"=>[],"status"=>404]);
        }
        $rules = [
            'tag' => 'required',
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
        $tag->update($request->all());}
        catch(\Exception $e){
            if ($e->getCode() == 23000){
                return response()->json(["message"=>"Tag already exists","data"=>[],"status"=>409]);
            }
            
        }
        return response()->json(["message"=>"Tag updated successfully","data"=>$tag,"status"=>200]);
    }
    public function destroy($id){
        $tag = Tags::find($id);
        if(!$tag){
            return response()->json(["message"=>"Tag not found","data"=>[],"status"=>404]);
        }
        $tag->delete();
        return response()->json(["message"=>"Tag deleted successfully","data"=>[],"status"=>200]);
    }
}
