<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Services\ValidationService;
use Illuminate\Http\Request;
use App\Models\UserJobDepartmentMap;
use App\Models\UserRoleDepartmentMap;
use App\Models\Department;
use App\Models\Jobs;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    //
    private $validator;
    public function __construct(ValidationService $validator)
    {   
        $this->validator = $validator;
    }
    public function index(){
        $users = User::with(['roles.department:id,name', 'roles.role:id,name', 'jobs.job:id,name'])
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.email_verified_at',
            'users.created_at',
            'users.updated_at',
            'users.birthdate'
        )
        ->get();
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'birthdate' => $user->birthdate,
                'department_name' => $user->roles->first()->department->name??null,
                'role_name' => $user->roles->role->name??null,
                'job_name' => $user->jobs->job->name??null,
            ];
        }

        return response()->json(["message"=>"","data"=>$data,"status"=>200]);
    }
   

public function store(Request $request)
{
    try {
        DB::beginTransaction();

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'department_id' => 'required',
            'start_date' => 'required',
            'job_id' => 'required'
        ];

        $validation = $this->validator->validateRequest($request, $rules);

        if ($validation['status'] == 422) {
            return response()->json($validation);
        }

        if ($request->end_date == null) {
            $request->end_date = null;
        }

        $user = User::create($request->all());

        $userRole = UserRoleDepartmentMap::create([
            'user_id' => $user->id,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
        ]);

        $userJob = UserJobDepartmentMap::create([
            'user_id' => $user->id,
            'job_id' => $request->job_id,
            'department_id' => $request->department_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        DB::commit();

        return response()->json(["message" => "User created successfully", "data" => $user, "status" => 200]);
    } catch (\Exception $e) {
        DB::rollBack();

        // Handle the exception as needed, you can log it or return an error response.
        return response()->json(["message" => "Error creating user", "error" => $e->getMessage(), "status" => 500]);
    }
}

    public function show($id){
        try{
        $user = User::with(['roles' => function ($query) {
            $query->latest()->first();
        }, 'jobs' => function ($query) {
            $query->latest()->first();
        }])
    ->select(
        'users.id',
        'users.name',
        'users.email',
        'users.email_verified_at',
        'users.created_at',
        'users.updated_at',
        'users.birthdate'
    )
    ->find($id);
    $data = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'email_verified_at' => $user->email_verified_at,
        'created_at' => $user->created_at,
        'updated_at' => $user->updated_at,
        'birthdate' => $user->birthdate,
        'department_name' => $user->roles->department->name,
        'role_name' => $user->roles->role->name,
        'job_name' => $user->jobs->job->name??null,
    ];
}catch (\Exception $e) {
    return response()->json(["message" => "Error getting user", "error" => $e->getMessage(), "status" => 500]);
}
    $response = ['data' => $data];

         
    
        if(!$user){
            return response()->json(["message"=>"User not found","data"=>[],"status"=>404]);
        }
        return response()->json(["message"=>"","data"=>$response,"status"=>200]);
    }
    public function update(Request $request, $id){
        try{
            DB::beginTransaction();
        $user = User::find($id);
        if(!$user){
            return response()->json(["message"=>"User not found","data"=>[],"status"=>404]);
        }
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'department_id' => 'required',
            'start_date' => 'required',
            
            
        ];
        $validation = $this->validator->validateRequest($request,$rules);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        if($request->end_date == null){
            $request->end_date = null;
        }
        $user->update($request->all());
        $userRole = UserRoleDepartmentMap::where('user_id', $id)->first();
        if($userRole->role_id != $request->role_id || $userRole->department_id != $request->department_id){
            $userRole = UserRoleDepartmentMap::create([
                'user_id' => $user->id,
                'role_id' => $request->role_id,
                'department_id' => $request->department_id,
            ]);
        }
        
        $userJob = UserJobDepartmentMap::where('user_id', $id)->first();
        // DD($request->job_id != $userJob->job_id || $userJob->department_id != $request->department_id);
        if ($userJob->job_id != $request->job_id || $userJob->department_id != $request->department_id) {
            $userJob->update([
                'end_date' => $request->start_date,
            ]);
            $userJob = UserJobDepartmentMap::create([
                'user_id' => $user->id,
                'job_id' => $request->job_id,
                'department_id' => $request->department_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            
        }
        
        DB::commit();
        
        
        
        return response()->json(["message"=>"User updated successfully","data"=>$user,"status"=>200]);
    } catch (\Exception $e) {
    
        
        return response()->json(["message" => "Error updating user", "error" => $e->getMessage(), "status" => 500]);}
    }
    public function destroy($id){
        if($id == 1 || $id == 3){
            return response()->json(["message"=>"You cannot delete this user","data"=>[],"status"=>403]);
        }
        $user = User::find($id);
        if(!$user){
            return response()->json(["message"=>"User not found","data"=>[],"status"=>404]);
        }
        $user->delete();
        return response()->json(["message"=>"User deleted successfully","data"=>[],"status"=>200]);
    }
}
