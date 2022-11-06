<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Instance;
use App\Models\Zones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstancesController extends Controller
{

    public function runningInstanceIdentity(){
     $url = 'IPv4 or IPv6/latest/dynamic/instance-identity/document';

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, 0);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

     $response = curl_exec ($ch);
     curl_close ($ch);
     return json_decode($response);
    }

    public function availibility_zones(){
        $zones = Zones::with('instances')->get();
        $availibility_zones = array();
        foreach($zones as $zone){
            foreach($zone->instances as $inst){
            array_push($availibility_zones,
             array(
                'instance_id' => $inst->name,
                'availibility_zone' => $zone->name,
                'active_zone' => $inst->pivot->active_zone == 1? 'Yes': 'No' )
            );
        }
        }
        return response()->json([
            'status' => "Availibility zones history successfully retrived",
            'availibility_zones' => $availibility_zones
    
        ], 200);

    }

    public function instance(Request $request){
        $instance = Instance::with('zones')->whereName($request->instance_id)->firstOrfail();
        $zones = array();
        foreach($instance->zones as $zone){
            array_push($zones,
             array(
                'availibility_zones' => $zone->name,
                'active_zone' => $zone->pivot->active_zone == 1? 'Yes': 'No' )
            );
        }
        return response()->json([
            'status' => "Availibility zones successfully retrived",
            'instance_id' => $instance->name,
            'zones' => $zones

        ], 200);
    }

    public function instances(){
        $query = Instance::with('zones')->get();
        $instances = array();
        foreach($query as $instance){
            foreach($instance->zones as $zone){
            array_push($instances,
             array(
                'availibility_zone' => $zone->name,
                'instance_id' => $instance->name,
                'active_zone' => $zone->pivot->active_zone == 1? 'Yes': 'No' )
            );
        }
        }
        return response()->json([
            'status' => "instances successfully retrived",
            'availibility_zones' => $instances
    
        ], 200);
    }

    public function store_avilability_zone(Request $request){

        // --identify instance data from the running instance dynamically

        // $runningInstance = $this->runningInstanceIdentity();
        // $instance_id = $runningInstance->instanceId;
        // $availability_zone = $runningInstance->availabilityZone;


        $validator = Validator::make($request->route()->parameters(), [
            'instance_id' => ['required'],    
            'availability_zone' => ['required'],    
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $instance = Instance::updateOrCreate(['name' => $request->instance_id]);

        $zone = Zones::updateOrCreate(['name' => $request->availability_zone]);

        $instance->zones()->syncWithoutDetaching($zone);


        foreach($instance->zones as $unavailable){
            $unavailable->instances()->updateExistingPivot($instance,["active_zone"=> false]);
        }
        
        $instance->zones()->updateExistingPivot($zone,['active_zone'=> true]);


        return response()->json([
            'status' => "Instance successfully stored",
            'zone' => $zone->instances,
            'instance' => $instance->zones
    
        ], 200);
        
    }

    public function view_zone_history(Request $request){

        $validator = Validator::make($request->route()->parameters(), [
            'availability_zone' => ['required'],    
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $zones = Zones::with('instances')->whereName($request->availability_zone)->firstOrfail();
        $instances = array();
        foreach($zones->instances as $inst){
            array_push($instances,
             array(
                'instance_id' => $inst->name,
                'active_zone' => $inst->pivot->active_zone == 1? 'Yes': 'No' )
            );
        }

        return response()->json([
                'status' => "Availability Zone successfully retrived",
                'availability_zone' => $request->availability_zone,
                'instances' => $instances,
    
        ], 200);
        
    }
}
