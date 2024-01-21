<?php

namespace App\Http\Controllers\ServiceControllers;
use App\Models\TimePeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimePeriodController extends Controller
{
    //
    public function index(){
        $timePeriods = TimePeriod::all();
        $timePeriods = $timePeriods->map(function($timePeriod){
            $timePeriod->quarter = strtoupper($timePeriod->quarter);
            return $timePeriod;
        });
        return response()->json(["message"=>"","data"=>$timePeriods,"status"=>200]);
    }
}
