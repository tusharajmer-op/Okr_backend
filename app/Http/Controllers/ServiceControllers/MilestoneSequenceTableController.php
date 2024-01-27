<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Milestone_Sequence_Table;
use App\Models\Milestone_Sequence_Templates;
use App\Services\ValidationService;

class MilestoneSequenceTableController extends Controller
{

    private $validator;
    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $milestoneSequenceTables =  Milestone_Sequence_Templates::with('milestone__sequence__templates')->get();
        return response()->json(['message' => 'MilestoneSequenceTable retrieved successfully', 'data' => $milestoneSequenceTables], 200);
        
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = $this->validator->validateRequest($request, [
            'template_name' => 'required|string',
            'milestone_sequence' => 'required|array',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $milestoneSequenceTemplate = Milestone_Sequence_Templates::create(['name'=>$request->template_name]);
        foreach($request->milestone_sequence as $milestoneSequence){
            $milestoneSequence['milestone_sequence_template_id'] = $milestoneSequenceTemplate->id;
            Milestone_Sequence_Table::create($milestoneSequence);
        }
        return response()->json(['message' => 'MilestoneSequenceTable created successfully', 'data' => $milestoneSequenceTemplate], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Milestone_Sequence_Table $milestone_Sequence_Table)
    {
        //
        $milestone_Sequence_Table = Milestone_Sequence_Table::with('milestone__sequence__templates')->find($milestone_Sequence_Table->id);
        return response()->json(['message' => 'MilestoneSequenceTable retrieved successfully', 'data' => $milestone_Sequence_Table], 200);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Milestone_Sequence_Table $milestone_Sequence_Table)
    {
        //
        $validation = $this->validator->validateRequest($request, [
            'template_name' => 'required|string',
            'milestone_sequence' => 'required|array',
        ]);
        if($validation['status'] == 422){
            return response()->json($validation);
        }
        $milestone_Sequence_Table->update(['name'=>$request->template_name]);
        foreach($request->milestone_sequence as $milestoneSequence){
            $milestoneSequence['milestone_sequence_template_id'] = $milestone_Sequence_Table->id;
            Milestone_Sequence_Table::create($milestoneSequence);
        }
        return response()->json(['message' => 'MilestoneSequenceTable updated successfully', 'data' => $milestone_Sequence_Table], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Milestone_Sequence_Table $milestone_Sequence_Table)
    {
        //
        $milestone_Sequence_Table->delete();
        return response()->json(['message' => 'MilestoneSequenceTable deleted successfully'], 200);
    }
}
