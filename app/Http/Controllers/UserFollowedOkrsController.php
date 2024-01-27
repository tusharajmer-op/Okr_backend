<?php

namespace App\Http\Controllers;
use App\Services\ValidationService;
use Illuminate\Http\Request;
use App\Models\userFollowedOkrs;
use App\Services\ObjectsServices;
class UserFollowedOkrsController extends Controller
{
    //
    private $validation;
    public function __construct(ValidationService $validationService)
    {
        $this->validation = $validationService;
    }
    public function index()
    {
        $userFollowedOkrs = userFollowedOkrs::with('user','objective')->get();
        return response()->json(['message' => 'UserFollowedOkrs retrieved successfully', 'data' => $userFollowedOkrs], 200);
    }
    public function store(Request $request)
    {
        $validation = $this->validation->validateRequest($request, [
            'objective_id' => 'required|integer',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $userId = $request->user['user_id'];
        $userFollowedOkrs = userFollowedOkrs::create(["user_id"=>$userId,"objective_id"=>$request->objective_id]);
        return response()->json(['message' => 'UserFollowedOkrs created successfully', 'data' => $userFollowedOkrs], 201);
    }
    public function show(userFollowedOkrs $userFollowedOkrs)
    {
        $userFollowedOkrs = userFollowedOkrs::with('user','objective')->find($userFollowedOkrs->id);
        if(!$userFollowedOkrs){
            return response()->json(["message"=>"UserFollowedOkrs not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$userFollowedOkrs,"status"=>200]);
    }
    public function update(Request $request, userFollowedOkrs $userFollowedOkrs)
    {
        $validation = $this->validation->validateRequest($request, [
            'user_id' => 'required|integer',
            'objective_id' => 'required|integer',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $userFollowedOkrs->update($request->all());
        return response()->json(['message' => 'UserFollowedOkrs updated successfully', 'data' => $userFollowedOkrs], 200);
    }
    public function destroy(userFollowedOkrs $userFollowedOkrs)
    {
        $userFollowedOkrs->delete();
        return response()->json(['message' => 'UserFollowedOkrs deleted successfully', 'data' => []], 204);
    }
    public function getUserFollowedOkrs(Request $request){
        $userFollowedOkrs = userFollowedOkrs::where('user_id',$request->user['user_id'])->get();
        if(!$userFollowedOkrs){
            return response()->json(["message"=>"UserFollowedOkrs not found","data"=>[],"status"=>404]);
        }
        $object_service= new ObjectsServices();
        $data = $object_service->showFollowedOkrs($userFollowedOkrs);
        return response()->json(['message' => 'UserFollowedOkrs retrieved successfully', 'data' => $data], 200);
    }
}
