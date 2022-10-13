<?php

namespace App\Http\Controllers\Nursery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reg_Nursery;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class regNurseryController extends Controller
{
    public function registerNursery(Request $request){
 
    $validator = Validator::make($request->all(),[
   'nur_name'=>'required|min:3|max:100',
   'nur_own_name'=>'required|min:3|max:100',
   'email'=>'required|email|unique:reg_nursery',
   'phone_num'=>'required|max:11',
   'web_link'=>'required',
   'password'=>'required|min:6|max:100',
   'confirm_password'=>'required|same:password'

]);
if ($validator->fails())
{
    // The given data did not pass validation
    return response()->json([

      'message'=>'Validations fails',
      'error'=>$validator->errors(),

    ],422);
}
    $nursery= new Reg_Nursery();
    $nursery->nur_name=$request->nur_name;
    $nursery->nur_own_name=$request->nur_own_name;
    $nursery->phone_num=$request->phone_num;
    $nursery->web_link=$request->web_link;
    $nursery->email=$request->email;
    $nursery->password=Hash::make($request->password);
    $nursery->save();
    $token=$nursery->createToken('authToken');
    return response()->json([
    'message'=>'Nursery registered successfully',
    'data'=>['token'=>$token->plainTextToken, 'reg_nursery'=>$nursery]
    ]);
    $errors = [$this->username() => trans('auth.failed')];
    // Load user from database
    $nursery = Reg_Nursery::where($this->username(), $request->{$this->username()})->first();

    if ($nursery && !Hash::check($request->password, $nursery->password)) {
        return $errors;
    $errors = ['password' => 'Wrong password'];


    }
}

}
