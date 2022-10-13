<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{




  function register(Request $request)
  {

    $validator = Validator::make($request->all(), [

      'name' => 'required|min:3|max:100',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6|max:100',
      'confirm_password' => 'required|same:password'

    ]);


    if ($validator->fails()) {
      // The given data did not pass validation
      return response()->json([

        'message' => 'Validations fails',
        'error' => $validator->errors()

      ], 422);
    }

    $user = new User;
    $user->name = $request->input("name");
    $user->email = $request->input("email");
    $user->password = Hash::make($request->input("password"));
    $user->save();



    $token = $user->createToken('authToken');
    return response()->json([
      'message' => 'user registered successfully',
      'data' => ['token' => $token->plainTextToken, 'user' => $user]
    ]);

    $errors = [$this->username() => trans('auth.failed')];
    // Load user from database
    $user = User::where($this->username(), $request->{$this->username()})->first();

    if ($user && !Hash::check($request->password, $user->password)) {
      $errors = ['password' => 'Wrong password'];
    }



    //$request->validate([
    //  'first_name'=>'required|min:3|max:100',
    //   'last_name'=>'required|min:3|max:100',
    //   'email'=>'required|email|unique:users',
    // 'password'=>'required|min:6|max:100',
    // 'confirm_password'=>'required|same:password'
    //]);



    //$user = User::create([
    //'name'=>$request->name,
    //'email'=>$request->email,
    //'password'=>Hash::make($request->password)
    //]);


    //return response()->json([
    //'message'=>'Registration successfully',
    //'token'=>$token,
    // 'data'=>$user
    //],200);

    //return response()->json([
    //'message'=>'Registration successfully',
    //'data'=>$user
    //],200);

    //  $user = new User;
    //  $user->first_name=$request->input("first_name");
    //  $user->last_name=$request->input("last_name");
    //  $user->email=$request->input("email");
    //  $user->password=Hash::make($request->input("password"));
    //  $user->save();

  }


  function login(Request $request)
  {
    $validator = Validator::make($request->all(), [

      'email' => 'required|email',
      'password' => 'required',
    ]);

    if ($validator->fails()) {
      // The given data did not pass validation
      return response()->json([
        'message' => 'Validations fails',
        'error' => $validator->errors()
      ], 422);
    }
    $user = User::where('email', $request->email)->first();
    if ($user) {
      if (Hash::check($request->password, $user->password)) {
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
          'message' => 'Login successfully',
          'token' => $token,
          'data' => $user
        ], 200);
      } else {
        return response()->json([
          'message' => 'incorrect credentials',
        ], 400);
      }
    } else {
      return response()->json([
        'message' => 'incorrect credentials',
      ], 400);
    }
  }

  public function viewUsers()
  {

    $user = User::all();
    return response()->json(['users' => $user], 200);
  }


  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return response()->json([
      'message' => 'user successfully logout',
    ], 200);
  }



  //forget password API Method
  public function forget_password(Request $request)
  {


    try {
      $user =  User::where('email', $request->email)->get();
      if (count($user) > 0) {
        $token = str::random(40);
        //  $id = Crypt::encrypt($user->id);
        $domain = URL::to('/');
        $url = $domain . '/reset-password/' . $token;
        $data['url'] = $url;
        $data['email'] = $request->email;
        $data['title'] = 'Reset Password';
        $data['body'] = 'Please click on below link to reset your password.';
        //$data['token']=$token;
        Mail::send('forgot_password', ['data' => $data], function ($message) use ($data) {
          $message->to($data['email'])
            ->subject($data['title']);
        });
        $datetime = Carbon::now()->format('Y-m-d H:i:s');
        PasswordReset::updateOrCreate(

          ['email' => $request->email],
          [
            'email' => $request->email,
            'token' => $token,
            'created_at' => $datetime
          ]
        );
        Session::flash('success', 'Please check your mail to reset your password');
        return response()->json([
          'success' => true,
          'msg' => 'Please check your mail to reset your password'
        ]);
      } else {
        return response()->json([

          'success' => 'false',
          'msg' => 'user not found',
        ]);
      }
    } catch (\Exception $e) {
      return response()->json([
        'success' => 'false',
        'msg' => $e->getMessage()
      ]);
    }
  }

  //reset password view load

  public function reset_password_load($token)
  {

    return view('resetPassword', ['token' => $token]);


    /*  $resertdata= PasswordReset::where('token',$request->token)->get();
  if(isset($request->token)&& count($resertdata)>0){
  $user =User::where('email',$resertdata[0]['email'])->first();
  return view('resetPassword', compact('user'));
  }
  else{

    return view('404');
  }*/
  }
//delete users
public function deleteUser(){
print("good");
}

  //password reset functionality
  public function reset_password(Request $request)
  {

    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required|string|min:6|Confirmed'
    ]);

    $updatePassword = DB::table('password_resets')
      ->where([
        'email' => $request->email,
        'token' => $request->token
      ])
      ->first();

    if (!$updatePassword) {
      return back()->withInput()->with('error', 'Invalid token!');
    }

    $user = User::where('email', $request->email)
      ->update(['password' => Hash::make($request->password)]);

    DB::table('password_resets')->where(['email' => $request->email])->delete();

    return "<h1>Your password has been reset successfully </h1> ";

    /*$user = new User();
$user = User::find($request->id);
$user->password = \Hash::make($request->password);
$user->save();
//dd($user->all());
 //or $user->save();
PasswordReset::where('email' , $user->email)->delete();*/
  }
}
//$user=User::where('email', $request->email)->first();
//if(!$user||!Hash::check($request->password, $user->password)){
  //return response([ 'error'=>["email or password not matched"]]);
//}

//  return $user;
