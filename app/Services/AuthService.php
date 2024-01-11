<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    /**
     * Attempt to authenticate the user and return a token.
     *
     * @param array $credentials
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($credentials)
    {
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token,$credentials);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$credentials)
    {   
        $user = Auth::user();
        
        $userDepartmentJobMap = $user->userRoleDepartmentMap()->where('user_id',$user->id)->first();
        if($token){
            $customClaims = ['user_id' => $user->id,'role_id'=>$userDepartmentJobMap->role_id,'department_id'=>$userDepartmentJobMap->department_id];
            $token = JWTAuth::claims($customClaims)->attempt($credentials);
            
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => $user->id,
                'Role'=> $userDepartmentJobMap->department_id,
                'Department' => $userDepartmentJobMap->role_id
            ]);
        }

        return response()->json([
            'error' => 'Unauthorized'
        ], 401);
        
    }
    public function checkToken($token=null){
        try {
            
            $authtoken = JWTAuth::parseToken($token)->authenticate();
            $payload = JWTAuth::getPayload($token)->toArray();
            
            
            return ['message'=>'success','data'=>$payload,'status'=>200];
            

        } catch (\Exception $e) {
            return ['message'=>'error','data'=>$e->getMessage(),'status'=>500];
        }
    }
}
