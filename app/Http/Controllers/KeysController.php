<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keys;
use App\Models\keystofrequencies;
use App\Models\keystoowner;
use App\Models\keystotags;
use App\Services\ValidationService;
use App\Models\CascadeApproach;
use App\Models\keysToObjects;
use Illuminate\Support\Facades\DB;
class KeysController extends Controller
{
    //
    private $validation;
    public function __construct(ValidationService $validationService)
    {
        $this->validation = $validationService;
    }
    public function index(){
        $keys = keys::all();
        return view('keys.index', compact('keys'));
    }
    public function store(Request $request){
        $validation = $this->validation->validateRequest($request, [
            'name' => 'required',
            'description' => 'required',
            'frequency' => 'required', 
            'objective_id' => 'required',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        try{
        DB::beginTransaction();
        $key = keys::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'keysubtype_id'=>$request->keysubtype_id,
            'cascade_approach_id'=>$request->cascade_approach_id,
            
        ]);
        // dd($request->owners);
        $keytofrequency = keystofrequencies::create(['key_id'=>$key->id,'frequency_id'=>$request->frequency]);
        foreach($request->owners as $owner){
            $owner = keystoowner::create(['key_id'=>$key->id,'owner_id'=>$owner]);
        }
        
        
        foreach($request->tags as $tag){
            $tag = keystotags::create(['key_id'=>$key->id,'tag_id'=>$tag]);
        }
        keysToObjects::create(['key_id'=>$key->id,'object_id'=>$request->objective_id]);
        DB::commit();
        return response()->json(['message' => 'Key created successfully', 'data' => $key], 201);
    }
    catch(\Exception $e){
        DB::rollback();
        return response()->json(['message' => $e, 'data' => [],'status'=>500], 500);
    }
    }

}
