<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Committee;
use function Symfony\Component\String\u;

class SeatController extends Controller{
	public function getSeat(Request $request,$u=0){
		$uid=$request->input("uid");
		if($u!=0){
			$uid=$u;
		}
		$seat=new Seat(uid: $uid);
		$seat=$seat->getSeat();
		$com=new Committee();
		$com=$com->getCommitteeInfo($seat->cid);
		$data=array($com->cid,$com->committee,$seat->seat);
		return $data;
		
	}
	
	public function hasSeat($uid){
		$seat=new Seat(uid: $uid);
		return $seat->hasSeat();
	}
	
	public function seatPage(Request $request){
		$uid=$request->session()->get("uid");
		$user=(new OAuthController())->GetInfo($uid);
		if(key_exists("Err",$user)){
			return redirect("/Actions/LogOut");
		}else{
			if((new EnrollmentController())->isEnrolled($uid)){
				$info=(new EnrollmentController())->enrollmentInfo($uid);
				$cid=$info->cid;
				if((new TestController())->isReviewed($uid,$cid)){
					$score=(new TestController())->getScore($request,u:$uid);
					$totalScore=$score[0]->score;
					$score[0]=$score[0]->committee;
					$reviewer=(new OAuthController())->GetInfo($score[2]);
					$score[2]=$reviewer["name"];
				}else{
					$totalScore=0;
					$score=0;
				}
				if($this->hasSeat($uid)){
					$seat=$this->getSeat($request,u:$uid);
				}else{
					$seat=0;
				}
				return view("seat",["user"=>$user,"score"=>$score,"seat"=>$seat,"totalScore"=>$totalScore]);
			}else{
				return redirect("/Enroll/Delegate");
			}
		}
	}
	
	public function setSeat(Request $request){
		/*
		 * 管理端
		 */
		$uid=$request->session()->get("uid");
		$user=(new OAuthController())->GetInfo($uid);
		$admin=new Admin(uid: $uid);
		$admin->getAdminInfo();
		$cid=$admin->cid;
		if($cid[0]==0){
			$scored=(new Score())->getScored();
			$committeeList=[];
			$coms=(new Committee())->getCommittees();
			foreach($coms as $c){
				$committeeList+=[$c->cid=>["cid"=>$c->cid,"committee"=>$c->committee,"score"=>$c->score]];
			}
		}else{
			$committeeList=[];
			foreach($cid as $c){
				$scored=(new Score())->getScored(cid: $c);
				$com=(new Committee())->getCommitteeInfo($c);
				$committeeList+=[$com->cid=>["cid"=>$com->cid,"committee"=>$com->committee,"score"=>$com->score]];
			}
		}
		$delInfo=[];
		$delegates=[];
		$seat=[];
		foreach($scored as $s){
			$delegates[]=$s["uid"];
			if($this->hasSeat($s["uid"])){
				$seat+=[$s["uid"]=>$this->getSeat($request,$s["uid"])];
			}else{
				$seat+=[$s["uid"]=>0];
			}
		}
		$info=(new OAuthController())->GetInfo($delegates);
		for($i=0;$i<count($delegates);$i+=1){
			$delInfo+=[$delegates[$i]=>$info[$i]];
		}
		return view("admin-seat",["user"=>$user,"delInfo"=>$delInfo,"delegates"=>$delegates,"delSeat"=>$seat,"scored"=>$scored,"committeeList"=>$committeeList]);
	}
	
	public function changeSeat(Request $request){
		$uid=$request->input("uid");
		$cid=$request->input("cid");
		$seat=$request->input("seat");
		$s=new Seat(uid:$uid,cid:$cid,seat:$seat);
		if($s->changeSeat()){
			echo("Success");
		}else{
			echo(json_encode(["Err"=>1]));
		}
	}
}
