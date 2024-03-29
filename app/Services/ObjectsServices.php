<?php

namespace App\Services;
use App\Models\User;
use App\Models\Objects;
use App\Models\ObjectCategoryMapping;
use App\Models\ObjectDepartmentMapping;
use App\Models\ObjectownerMapping;
use App\Models\ObjectTagMapping;
use App\Models\ObjectVisibilityListMapping;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\RenameForceCoversAnnotationAttribute;

class ObjectsServices{

    private function formatObject($objectives){
        $data = [];
    // dd($objectives[1]->objectVisbilityListMapping[0]->objectVisibilityListUser->name);
    foreach ($objectives as $objective) {
        $owners = $objective->ObjectownerMapping->map(function ($ownerMapping) {
            return $ownerMapping->objectOwnerList->name;
        })->implode(', ');
        // dd($objective->objectTimePeriodMapping);
        $time_period = $objective->objectTimePeriodMapping ? $objective->objectTimePeriodMapping->year . ' ' . strtoupper($objective->objectTimePeriodMapping->quarter) : '';
        switch($objective->objectTimePeriodMapping?->quarter){
            case 'q1':
                $duration = 'Jan 1 - Mar 31'; 
                break;
            case 'q2':
                $duration = 'Apr 1 - Jun 30'; 
                break;
            case 'q3':
                $duration = 'Jul 1 - Sep 30'; 
                break;
            case 'q4':
                    $duration = 'Oct 1 - Dec 31';
                    break;
        }
        $tags = $objective->ObjectTagMapping ? $objective->ObjectTagMapping->map(function ($tagMapping) {
            return $tagMapping->objectTagList->tag;
        })->implode(', ') : '';
        $access_list = $objective->objectVisbilityListMapping ? $objective->objectVisbilityListMapping->map(function ($access_list) {
            return $access_list->objectVisibilityListUser?->name;
        })->implode(', ') : '';
        $data[] = [
            "id" => $objective->id,
            "name" => $objective->object_name,
            "description" => $objective->object_description,
            "status" => $objective->object_status,
            "visibility" => $objective->object_visibility,
            "category" => $objective->objectCategoryMapping->objectCategoryList->category,
            "department" => $objective ? $objective->objectDepartmentMappingList->name : null,
            "owners" => $owners,
            "tags" => $tags,
            "time_period" => $time_period,
            "duration" => $duration,
            "access_list" => $access_list,
            "created_by" => $objective->objectCreatedByMapping->name,
             
        ];
    }
    return $data;
    }
    public function storeObjects($request){
        
        try{
        DB::beginTransaction();
        $object = Objects::create([
            "object_name"=>$request->name,
            "object_type"=>$request->is_private == True? 'user':'department',
            "object_description"=>$request->description == null? '':$request->description,
            "object_status"=>'active',
            "object_visibility"=>$request->visibility,
            "created_by"=>$request->user['user_id'],
            "department_id"=>$request->user['department_id'],  
        ]);
        $objectCategoryMapping = ObjectCategoryMapping::create([
            "object_id"=>$object->id,
            "category_id"=>$request->category
        ]);
        
        switch($request->visibility){
            case 'department':
                $objectDepartmentMapping = ObjectDepartmentMapping::create([
                    "object_id"=>$object->id,
                    "department_id"=>$request->user['department_id']
                ]);
                break;
            case 'accesslist':
                if ($request->access_list == null){
                    break;
                }
                foreach($request->access_list as $access_list){
                    $objectVisibilityListMapping = ObjectVisibilityListMapping::create([
                        "object_id"=>$object->id,
                        "user_id"=>$access_list
                    ]);
                }
                break;
        }
        if ($request->owners != []){
            $objectOwnerMapping = ObjectownerMapping::create([
                "object_id"=>$object->id,
                "owner_id"=>$request->user['user_id']
            ]);
            foreach($request->owners as $owner){
                $objectOwnerMapping = ObjectownerMapping::create([
                    "object_id"=>$object->id,
                    "owner_id"=>$owner
                ]);
            }
        }
        else{
            $objectOwnerMapping = ObjectownerMapping::create([
                "object_id"=>$object->id,
                "owner_id"=>$request->user['user_id']
            ]);
        }
        if ($request->tags != []){
            
            foreach($request->tags as $tag){
                info($tag); 
                $objectTagMapping = ObjectTagMapping::create([
                    "object_id"=>$object->id,
                    "tag_id"=>$tag
                ]);
            }
        }
        DB::commit();
        return ["message"=>"Object created successfully","data"=>[],"status"=>200];
        
    }catch(\Exception $e){  
        DB::rollback();
        return ["message"=>"Something went wrong" . $e,"data"=>[],"status"=>500];
    }
}
public function showobjects(){
    $objectives = Objects::with('objectCategoryMapping','objectDepartmentMapping','objectOwnerMapping','objectTagMapping','objectVisbilityListMapping','objectTimePeriodMapping')->get();
    $data = $this->formatObject($objectives);
    
    
    return response()->json(["message" => "", "data" => $data, "status" => 200]);
    
}
 public function deleteobject($id){
    $objective = Objects::find($id);
    if(!$objective){
        return response()->json(["message"=>"Object not found","data"=>[],"status"=>404]);
    }
    $objective->delete();
    return response()->json(["message"=>"Object deleted successfully","data"=>[],"status"=>200]);
 }

 public function showMyokrs($request){
    $objectives = Objects::with('objectCategoryMapping','objectDepartmentMapping','objectOwnerMapping','objectTagMapping','objectVisbilityListMapping')
    ->where('created_by',$request->user['user_id'])
    ->get();
    $data = $this->formatObject($objectives);
    return response()->json(["message" => "", "data" => $data, "status" => 200]);
}
public function showMyDepartmentOkrs($request){
    $objectives = Objects::with('objectCategoryMapping','objectDepartmentMapping','objectOwnerMapping','objectTagMapping','objectVisbilityListMapping')
    ->where('department_id',$request->user['department_id'])
    ->get();
    $data = $this->formatObject($objectives);
    return response()->json(["message" => "", "data" => $data, "status" => 200]);
}
public function showFollowedOkrs($object_id){
    $data = [];
    foreach($object_id as $id){
        $objectives = Objects::with('objectCategoryMapping','objectDepartmentMapping','objectOwnerMapping','objectTagMapping','objectVisbilityListMapping')
        ->where('id',$id->objective_id)
        ->get();
        $data[] = $this->formatObject($objectives);
    }
    return response()->json(["message" => "", "data" => $data, "status" => 200]);
}
}
