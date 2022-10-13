<?php

namespace App\Http\Controllers\Nursery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Available;
use App\Models\Plant;

class AvailableController extends Controller
{

      //add avaiability of plants in nurseries
      public function checkAvailability(Request $request){

        $request-> validate([
       'plant_available'=>'required',
       'plant_id' =>'required',
     ]);


     $plant = new Plant();

     $availables = new Available();
     $availables->plant_available= $request->plant_available;
     $availables->plant_id = $plant->id;
     $availables->save();

     if($availables){

       return response()->json([
         'success'=>'true',
         'message'=>'Plant Availibiity Added Successfully',
       ],200);
     }

     else{
       return response()->json([
         'success'=>'false',
         'message'=>'Plant Availibiity Added fail',
       ],404);
     }

    // $plantId = $request->plant_id;
    // $plantAv = $request->plant_available;

    // $availables = new Available();
     //$availables->plant_id = $plantId;
     //$availables->plant_available = $plantAv;





      /*  $request-> validate([
        'plant_available'=>'required',
        'plant_id' =>'required',
      ]);

        $availables=request()->get('plant_id');
        $availables = new Available();

        $availables->plant_available=$request->plant_available;
          $result=$availables->save();
          if($result){

          return response()->json(['success'=>true]);
          }
          else {
            return response()->json(['success'=>false]);
          }
      }*/

}

      public function viewForignKey(){

          $availables= Available::select('plant_id')->get();
          return response()->json(['availables'=>$availables],200);

      }



}
