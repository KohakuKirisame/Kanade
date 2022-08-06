<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;

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
Route::get('/s/{uid}', function ($uid){
	return redirect("https://灵.星云模联.中国/s/" . $uid);
});

Route::get('/', [DashboardController::class,"displayDashboard"])->middleware("auth");

Route::get('/Test',[TestController::class,"testPage"])->middleware("auth");

Route::get("/Enroll/{type}",function ($type){
	$uid=Session::get("uid");
	$user=(new OAuthController())->GetInfo($uid);
	if(key_exists("Err",$user)){
		return redirect("/Actions/LogOut");
	}else{
		if(!(new EnrollmentController())->isEnrolled($uid)){
			switch($type){
				case "Delegate":
					$t=0;
					break;
				case "Observer":
					$t=1;
					break;
				case "Academic":
					$t=2;
					break;
				default:
					return redirect("/");
			}
			$time=(new ConferenceController())->getTimeByType($t);
			$start=$time[0];
			$ddl=$time[1];
			if(time()<strtotime($start)){
				return view("not-start",["user"=>$user,"start"=>$start]);
			}else{
				$coms=(new CommitteeController())->getCommittees();
				return view("enroll",["user"=>$user,"type"=>$t,"ddl"=>$ddl,"coms"=>$coms]);
			}
		}else{
			return redirect("/");
		}
	}
})->middleware("auth");

Route::get("/Seat",[SeatController::class,"seatPage"]);

Route::get("/Login", function (){
	return view("login");
});

Route::prefix("Admin")->group(function(){
	Route::get("/User", function (){
		$user=(new OAuthController())->GetInfo(Session::get("uid"));
		if(key_exists("Err",$user)){
			return redirect("/Actions/LogOut");
		}else{
			return view('admin-user', ["user" => $user]);
		}
	})->middleware("issupadmin");
	
	Route::get("/Delegate",[EnrollmentController::class,"getDelegate"])->middleware("isDM");
	Route::get("/Test",[TestController::class,"getTest"])->middleware("isDM");
	Route::get("/Test/{eid}",[TestController::class,"testReview"])->middleware("isDM");
	Route::get("/Seat",[SeatController::class,"setSeat"])->middleware("isDM");
	
});

Route::get("About",[DashboardController::class,"toAbout"]);

Route::prefix("Actions")->group(function(){
	Route::post("/UpdateCommittee", [CommitteeController::class, "updateCommittee"])->middleware("issupadmin");
	Route::post("/GetScore",[TestController::class,"getScore"]);
	Route::post("/GetSeat",[SeatController::class,"getSeat"]);
	Route::post("/UpdateAnswer",[TestController::class,"updateAnswer"]);
	Route::post("/Enroll",[EnrollmentController::class,"enroll"]);
	Route::post("/Quit",[EnrollmentController::class,"quit"]);
	Route::post("/SaveScore",[TestController::class,"saveScore"])->middleware("isDM");
	Route::post("/ChangeSeat",[SeatController::class,"changeSeat"])->middleware("isDM");
	
	Route::get("/Auth",[OAuthController::class,"Auth"]);
	Route::get("/LogOut",[OAuthController::class,"LogOut"]);
});
