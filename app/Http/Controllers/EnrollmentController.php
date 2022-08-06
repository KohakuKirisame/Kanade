<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Conference;
use App\Models\Bill;
use App\Models\Admin;
use App\Models\Committee;

class EnrollmentController extends Controller{
	public function isEnrolled($uid){
		return (new Enrollment(uid: intval($uid)))->isEnrolled();
	}
	
	public function enrollmentInfo($uid){
		return (new Enrollment(uid: intval($uid)))->enrollmentInfo();
	}
	
	public function enroll(Request $request){
		$uid=$request->session()->get("uid");
		if($this->isEnrolled($uid)){
			return redirect("/");
		}
		$input=$request->input();
		$type=intval($input["type"]);
		$invitation_code=$input["invitation_code"];
		$cid=$input["committee"];
		$invitation_code=strtoupper($invitation_code);
		if($type<=1){
			$cost=(new Conference())->getCost($type);
			$bill=(new Bill())->creatBill($uid,"会费",$cost[0]);
			$bill=(new Bill())->creatBill($uid,"住宿费",$cost[1]);
		}
		$enroll=(new Enrollment())->enroll($uid,$type,$invitation_code,$cid);
		echo(1);
	}
	
	public function quit(Request $request){
		$uid=$request->session()->get("uid");
		$quit=(new Enrollment(uid:$uid))->quit();
		$quit=(new Bill())->quit($uid);
		echo(1);
	}
	
	public function getDelegate(Request $request){
	/*
	 * 管理端
	 */
		$uid=intval($request->session()->get("uid"));
		$user=(new OAuthController())->GetInfo($uid);
		$admin=new Admin(uid:$uid);
		$admin->getAdminInfo();
		$cid=$admin->cid;
		if($cid[0]==0){
			$committeeList=[];
			$coms=(new Committee())->getCommittees();
			foreach($coms as $c){
				$committeeList+=[$c->cid=>["cid"=>$c->cid,"committee"=>$c->committee]];
			}
		}else{
			$committeeList=[];
			foreach($cid as $committee){
				$com=(new Committee())->getCommitteeInfo($committee);
				$committeeList+=[$com->cid=>["cid"=>$com->cid,"committee"=>$com->committee]];
				
			}
		}
		$delegates=[];
		$delegatesInfo=[];
		$myGiantDick=[];
		foreach($committeeList as $c){
			$enrollments=(new Enrollment(cid: $c["cid"]))->getEnrollmentByCid(1);
			foreach($enrollments as $enrollment){
				$delegates[]=$enrollment["uid"];
				$myGiantDick+=[$enrollment["uid"]=>["cid"=>$enrollment["cid"],"committee"=>$committeeList[$enrollment["cid"]]["committee"],"type"=>$enrollment["type"]]];
				$bills=(new Bill())->getBill($enrollment["uid"]);
				$bill=[];
				foreach($bills as $b){
					$bill[]=$b->purchased;
				}
				$myGiantDick[$enrollment["uid"]]+=["bill"=>$bill];
			}
		}
		$info=(new OAuthController())->GetInfo($delegates);
		for($i=0;$i<count($delegates);$i+=1){
			$delegatesInfo+=[$delegates[$i]=>$info[$i]];
		}
		return view("admin-delegate",["user"=>$user,"committeeList"=>$committeeList,"delegates"=>$delegates,"delegatesInfo"=>$delegatesInfo,"delCom"=>$myGiantDick]);
	}
}
