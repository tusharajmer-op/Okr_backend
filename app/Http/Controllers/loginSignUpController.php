<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\ValidationService;
class loginSignUpController extends Controller
{
    //
    protected $authService;
    private $validationService;

    public function __construct(AuthService $authService)
    {   $this->validationService = new ValidationService();
        $this->authService = $authService;
    }
    public function login(Request $request)
    {   
         $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6'];
        $response = $this->validationService->validateRequest($request, $rules);
        if($response['status']!=200)
        {
            return response()->json($response);
        }
        
        $requestdata = $request->all();

        $response = $this->authService->login($requestdata);
        return response()->json($response);
        // return "hello";
    }
}