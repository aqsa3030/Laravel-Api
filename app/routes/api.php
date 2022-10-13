<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\UserController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Nursery\AvailableController;
use App\Http\Controllers\Nursery\regNurseryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware ([('auth:sanctum'),'verified'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/verified-only', function(Request $request){

    dd('your are verified', $request->user()->name);
})->middleware('auth:sanctum','verified');

Route::post('registeration', [UserController::class, 'register']);
Route::post('login1', [UserController::class, 'login']);


//view all users
Route::get('seeAll',[UserController::class,'dot']);
// insert plants API route
Route::post('insert', [PlantController::class, 'insert']);
// view all plants route
Route::get('view',[PlantController::class,'view']);
//search by id API route
Route::get('/view/{id}/viewById',[PlantController::class, 'viewById']);
// serch by common name API route
Route::get('/view/{common_name}',[PlantController::class,'search']);
// delete API route
Route::delete('/delete/{id}',[PlantController::class, 'delete']);
//update API route
Route::post('/update/{id}',[PlantController::class,'update']);
//view common name and image Api route
Route::get('/viewGallery',[PlantController::class,'viewGallery']);
// for verfication and send varification link.
Route::get('/email/resend',[VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/email/verify/{id}/{hash}',[VerificationController::class, 'verify'])->name('verification.verify');

//add status, that plant is available on nurseries or not, API route
Route::get('/addStatus', [AvailableController::class, 'checkAvailability']);

// get plantid (forign key)
Route::get('/viewPlantID', [AvailableController::class, 'viewForignKey']);
//fetch all data of nursery available table
Route::get('/checkPlantStatus', [PlantController::class,'viewAvailibility']);

Route::post('/viewAddedPlantsOfNurseries', [PlantController::class,'state']);
Route::post('/postAvailibility', [PlantController::class,'state2']);


Route::get('/aqsa', [PlantController::class,'aqsa']);

Route::post('/registerNursery', [regNurseryController::class,'registerNursery']);
