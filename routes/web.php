<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SeatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
	return view('welcome');
});

Route::get('/s/{uid}', function ($uid){
	return redirect("https://灵.星云模联.中国/s/" . $uid);
});

Route::get("/committees", [CommitteeController::class, "getCommittees"]);

Route::prefix("Actions")->group(function(){
	Route::post("/UpdateCommittee", [CommitteeController::class, "updateCommittee"])->middleware("issupadmin");
	Route::post("/GetScore",[ScoreController::class,"getScore"])->middleware("isself");
	Route::post("/GetSeat",[SeatController::class,"getSeat"])->middleware("isself");
});
