<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller{
	public function displayDashboard(Request $request){
		$uid=intval($request->session()->get("uid"));
		$user=(new OAuthController())->GetInfo($uid);
		if(key_exists("Err",$user)){
			return redirect("/Actions/LogOut");
		}else{
			$isEnrolled=(new EnrollmentController())->isEnrolled($uid);
			if($isEnrolled){
				$info = (new EnrollmentController())->enrollmentInfo(Session::get("uid"));
				$committee = (new CommitteeController())->getCommitteeInfo($info->cid);
				$staff = (new CommitteeController())->getStaff($info->cid);
				$ddl=(new ConferenceController())->getTime($uid)[1];
				$bill=(new BillController())->getBill($uid);
				$paymentInfo=(new ConferenceController())->getPaymentInfo();
			}else{
				$info = 0;
				$committee = 0;
				$staff = 0;
				$bill=0;
				$ddl="2099-12-31 00:00:00";
				$paymentInfo=0;
			}
			return view('dashboard',["user"=>$user,"isEnrolled"=>$isEnrolled,"ddl"=>$ddl,"info"=>$info,"committee"=>$committee,"staff"=>$staff,"bill"=>$bill,"paymentInfo"=>$paymentInfo]);
		}
	}
	
	public function toAbout(Request $request){
		$uid=Session::get("uid");
		$user=(new OAuthController())->GetInfo($uid);
		if(key_exists("Err",$user)){
			return redirect("/Actions/LogOut");
		}else{
			$info=(new ConferenceController())->getConferenceInfo();
			$head=[];
			$contact=[];
			foreach($info[7] as $i){
				$head[]=(new OAuthController())->GetInfo($i);
			}
			foreach($info[8] as $i){
				$contact[]=(new OAuthController())->GetInfo($i);
			}
			return view("about",["info"=>$info,"user"=>$user,"head"=>$head,"contact"=>$contact]);
		}
	}
}