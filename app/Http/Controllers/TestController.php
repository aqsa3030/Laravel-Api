<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Mail;
class TestController extends Controller
{

  public function getApi(){

      $data=['name'=>'aqsa', 'data'=>'hello! Aqsa'];
      $user['to']='growiser10@gmail.com';
      Mail::send('mail', $data, function($messages) use($user){

          $messages->to($user['to']);
          $messages->subject('hello Aqsa');

      });

  }


  public function image(){

  }

}
