<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Plant, Available};
use Illuminate\Support\Facades\{File, Validator, Log};


class PlantController extends Controller
{

  public function insert(Request $request)
  {

    // return dd("insert api");
    // let me add one record after that you can follow.  okay.
    //  from now i just disable the validation.
    $plant = new Plant();
    $request->validate([
      'common_name' => 'required',
      'botanical_name' => 'required',
      'plant_description' => 'required',
      'temperature' => 'required',
      'max_temperature' => 'required',
      'humidity' => 'required',
      'max_humidity' => 'required',
      'soil_ph' => 'required',
      'max_soil_ph' => 'required',
      'min_light' => 'required',
      'max_light' => 'required',
      'nitrogen' => 'required',
      'phosphorus' => 'required',
      'potassium' => 'required',
      'plant_type' => 'required',
      'plant_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('plant_image')) {
      $filename = $request->file('plant_image');
      $file_extension = $filename->getClientOriginalName();
      $destination_path = public_path() . '/plantPhotos';
      $filename = $file_extension;
      $request->file('plant_image')->move($destination_path, $filename);
      $input['plant_image'] = $filename;
    } else {
      $filename = Null;
    }


    // if($request->plant_image && $request->plant_image->isValid()){
    //   $fileName = time().'.'.$request->plant_image->extension();
    //   $request->plant_image->move(public_path('plantPhotos'),$fileName);
    //   $path = "public/plantPhotos/$fileName";
    //   $plant->plant_image = $path;}

    $plant->common_name = $request->common_name;
    $plant->botanical_name = $request->botanical_name;
    $plant->plant_description = $request->plant_description;
    $plant->temperature = $request->temperature;
    $plant->max_temperature = $request->max_temperature;
    $plant->humidity = $request->humidity;
    $plant->max_humidity = $request->max_humidity;
    $plant->soil_ph = $request->soil_ph;
    $plant->max_soil_ph = $request->max_soil_ph;
    $plant->min_light = $request->min_light;
    $plant->max_light = $request->max_light;
    $plant->nitrogen = $request->nitrogen;
    $plant->phosphorus = $request->phosphorus;
    $plant->potassium = $request->potassium;
    $plant->plant_type = $request->plant_type;
    $plant->plant_image = $filename;
    $result = $plant->save();
   
    if ($result) {
      
      return response()->json([
        'message' => 'Plant Added Successfully',
        'plants' => $plant
      ]);
    } else {
      return response()->json(['message' => 'false']);
    }
  }
  // View All Plants
  public function view()
  {
    $plant = Plant::all();
    return response()->json(['plants' => $plant], 200);
  }

  //view Common Name and Image from Database

  public function viewGallery()
  {
    $plant = Plant::select('common_name', 'plant_image')->get();
    return response()->json(['plants' => $plant], 200);
  }



  // view By Id API
  public function viewById($id)
  {
    $plant = Plant::find($id);
    if ($plant) {
      return response()->json(['plants' => $plant], 200);
    } else {
      return response()->json(['message ' => 'Records not found '], 404);
    }
  }


  public function search($common_name)
  {
    $result = Plant::where('common_name', "like", "%" . $common_name . "%")->get();
    if (count($result) > 0) {
      return $result;
    } else {
      return $common_name . ' ' . 'is not exists in records found';
    }
  }



  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [

      'common_name' => 'required',
      'botanical_name' => 'required',
      'plant_description' => 'required',
      'temperature' => 'required',
      'max_temperature' => 'required',
      'humidity' => 'required',
      'max_humidity' => 'required',
      'soil_ph' => 'required',
      'max_soil_ph' => 'required',
      'min_light' => 'required',
      'max_light' => 'required',
      'nitrogen' => 'required',
      'phosphorus' => 'required',
      'potassium' => 'required',
      'plant_type' => 'required',
      'plant_image' => 'nullable|image|mimes:jpg,png,bmp',
    ]);

    if ($validator->fails()) { // The given data did not pass validation
      return response()->json([
        'message' => 'Validations fails',
        'error' => $validator->errors()
      ], 422);
    }

    $plant = Plant::findOrFail($id);
    if ($request->hasFile('plant_image')) {
      if ($plant->plant_image) {
        $old_path = public_path() . '/plantPhotos/' . $plant->plant_image;
        if (File::exists($old_path)) {
          File::delete($old_path);
        }
      }
      $image_name = 'new_image' . time() . '.' . $request->plant_image->extension();
      $request->plant_image->move(public_path('/plantPhotos'), $image_name);
    } else {
      $image_name = $plant->plant_image;
    }
    $plant->update([
      'common_name' => $request->common_name,
      'botanical_name' => $request->botanical_name,
      'plant_description' => $request->plant_description,
      'temperature' => $request->temperature,
      'max_temperature' => $request->max_temperature,
      'humidity' => $request->humidity,
      'max_humidity' => $request->max_humidity,
      'soil_ph' => $request->soil_ph,
      'max_soil_ph' => $request->max_soil_ph,
      'min_light' => $request->min_light,
      'max_light' => $request->max_light,
      'nitrogen' => $request->nitrogen,
      'phosphorus' => $request->phosphorus,
      'potassium' => $request->potassium,
      'plant_type' => $request->plant_type,
      'plant_image' => $image_name,

    ]);
    return response()->json(['msg' => 'Plant updated successfully'], 200);
  }


  public function delete($id)
  {
    $plant = Plant::findOrFail($id);
    //   $destination=public_path("storage\\".$plant->plant_image);
    // if(File::exists($destination)){
    //   File::delete($destination);
    //}
    $result = $plant->delete();
    if ($result) {
      return response()->json(['success' => true]);
    } else {
      return response()->json([ 'success' => false,]);
    }
  }


  //sir ya API project ha or esma plantPhotos ka folder ha ya wala 
  public function viewAvailibility($id)
  {

    return Plant::find($id)->getStatus;
  }
  public function state(Request $request)
  {

    $plant = new Plant();
    $plant->common_name = $request->common_name;
    $plant->botanical_name = $request->botanical_name;
    $plant->plant_description = $request->plant_description;
    $plant->temperature = $request->temperature;
    $plant->humidity = $request->humidity;
    $plant->soil_ph = $request->soil_ph;
    $plant->nitrogen = $request->nitrogen;
    $plant->phosphorus = $request->phosphorus;
    $plant->potassium = $request->potassium;
    $plant->plant_type = $request->plant_type;
    $plant->plant_image = $request->plant_image;
    $result = $plant->save();
    $availables = new Available();
    $availables->plant_available = $request->plant_available;
    $result = $plant->Available()->save($availables);
    if ($result) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }


  public function InserwithKey(Request $request)
  {
    $plant = new Plant();
    $availables = new Available();
    $availables->plant_available = $request->plant_available;
    $result = $plant->Available()->save($availables);
    if ($result) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }

  public function update2(Request $request)
  {
    $plant = new Plant();

    if ($request->hasFile('plant_image')) {
      if ($plant->plant_image) {
        $old_path = public_path() . '/plantPhotos/' . $plant->plant_image;
      }
      if (File::exists($old_path)) {

        File::delete($old_path);
      }
      $plant_image = time() . '.' . $request->plant_image->extension();
      $request->plant_image->move(public_path('plantPhotos'), $plant_image);
    } else {
      $plant_image = $plant->plant_image;
    }
    $plant->update([
      'common_name' => $request->common_name,
      'botanical_name' => $request->botanical_name,
      'plant_description' => $request->plant_description,
      'temperature' => $request->temperature,
      'max_temperature' => $request->max_temperature,
      'humidity' => $request->humidity,
      'max_humidity' => $request->max_humidity,
      'soil_ph' => $request->soil_ph,
      'max_soil_ph' => $request->max_soil_ph,
      'Min_Light' => $request->Min_Light,
      'Max_Light' => $request->Max_Light,
      'nitrogen' => $request->nitrogen,
      'phosphorus' => $request->phosphorus,
      'potassium' => $request->potassium,
      'plant_type' => $request->plant_type,
      'plant_image' => $request->plant_image,
    ]);

    return response()->json([
      'message' => 'Plant Update Successfully',
    ], 200);
  }
}
