<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Bill;
use App\Models\Committee;
use App\Models\Enrollment;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class TestController extends Controller{
	public function getAnswer($uid,$qid=[]){
		$answers=(new Answer())->getAnswer($uid,$qid);
		return $answers;
	}
	
	public function updateAnswer(Request $request){
		$uid=$request->session()->get("uid");
		$data=$request->input("data");
		if((new Answer())->updateAnswer($uid,$data)){
			echo("Success");
		}
	}
	public function getQuestion($cid,$type){
		$questions=(new Question())->getQuestion($cid,$type);
		return $questions;
	}
	
	public function testPage(Request $request){
		$uid=$request->session()->get("uid");
		$user=(new OAuthController())->GetInfo($uid);
		if(key_exists("Err",$user)){
			return redirect("/Actions/LogOut");
		}else{
			if((new EnrollmentController())->isEnrolled($uid)){
				$ddl=(new ConferenceController())->getTime($uid)[1];
				$info=(new EnrollmentController())->enrollmentInfo($uid);
				if($info->type==1){
					return redirect("/");
				}
				$questions=$this->getQuestion($info->cid,$info->type);
				$qid=[];
				foreach($questions as $i){
					$qid[]=$i->qid;
				}
				$answers=$this->getAnswer($uid,$qid);
				$data=[];
				foreach($questions as $q){
					foreach($answers as $a){
						if($q->qid==$a->qid){
							$data[]=[
								"qid"=>$a->qid,
								"question"=>$q->question,
								"answer"=>$a->answer
							];
						}
					}
				}
				return view('test',["user"=>$user,"data"=>$data,"ddl"=>$ddl]);
			}else{
				return redirect("/");
			}
		}
	}
	
	public function getScore(Request $request,$u=0){
		$uid=$request->input("uid");
		if($u!=0){
			$uid=intval($u);
		}
		$score=new Score(uid:$uid);
		$score=$score->getScore();
		$com=new Committee();
		$com=$com->getCommitteeInfo($score->cid);
		$data=array($com,$score->score,$score->reviewer);
		return $data;
	}
	
	public function isReviewed($uid,$cid){
		return (new Score(uid: $uid,cid: $cid))->isReviewed();
	}
	
	public function getTest(Request $request){
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
		$myGiantDick=[];
		$delegatesInfo=[];
		foreach($committeeList as $c){
			$enrollments=(new Enrollment(cid: $c["cid"]))->getEnrollmentByCid(0);
			foreach($enrollments as $enrollment){
				$delegates[]=$enrollment["uid"];
				$myGiantDick+=[$enrollment["uid"]=>["eid"=>$enrollment["eid"],"cid"=>$enrollment["cid"],"committee"=>$committeeList[$enrollment["cid"]]["committee"],"type"=>$enrollment["type"]]];
				$bills=(new Bill())->getBill($enrollment["uid"]);
				$bill=[];
				foreach($bills as $b){
					$bill[]=$b->purchased;
				}
				$myGiantDick[$enrollment["uid"]]+=["bill"=>$bill];
				$isReviewed=$this->isReviewed($enrollment["uid"],$enrollment["cid"]);
				$myGiantDick[$enrollment["uid"]]+=["isReviewed"=>$isReviewed];
			}
		}
		$info=(new OAuthController())->GetInfo($delegates);
		for($i=0;$i<count($delegates);$i+=1){
			$delegatesInfo+=[$delegates[$i]=>$info[$i]];
		}
		return view("admin-test",["user"=>$user,"committeeList"=>$committeeList,"delegates"=>$delegates,"delTest"=>$myGiantDick,"delegatesInfo"=>$delegatesInfo]);
	}
	
	public function testReview(Request $request,$eid){
		/*
		 * 管理端
		 */
		$uid=$request->session()->get("uid");
		$user=(new OAuthController())->GetInfo($uid);
		$enrollment=new Enrollment(eid: intval($eid));
		$enrollment->getEnrollmentByEid();
		if($enrollment->type==1){
			return redirect("/");
		}
		$ddl=(new ConferenceController())->getTime($enrollment->uid)[1];
		$com=(new Committee())->getCommitteeInfo($enrollment->cid);
		$totalScore=floatval($com->score);
		$questions=$this->getQuestion($enrollment->cid,$enrollment->type);
		$qid=[];
		foreach($questions as $i){
			$qid[]=$i->qid;
		}
		$answers=$this->getAnswer($enrollment->uid,$qid);
		$data=[];
		foreach($questions as $q){
			foreach($answers as $a){
				if($q->qid==$a->qid){
					$data[]=[
						"qid"=>$a->qid,
						"question"=>$q->question,
						"answer"=>$a->answer,
						"updateTime"=>$a->update_time
					];
				}
			}
		}
		if($this->isReviewed($enrollment->uid,$enrollment->cid)){
			$score=$this->getScore(request: $request,u: $enrollment->uid);
			$reviewer=(new OAuthController())->GetInfo($score[2]);
			$score[2]=$reviewer["name"];
		}else{
			$score=0;
		}
		return view("admin-testreview",["user"=>$user,"ddl"=>$ddl,"eid"=>$eid,"data"=>$data,"totalScore"=>$totalScore,"score"=>$score]);
	}
	
	public function saveScore(Request $request){
		/*
		 * 管理端
		 */
		$uid=$request->session()->get("uid");
		$eid=$request->input("eid");
		$score=floatval($request->input("score"));
		$e=new Enrollment(eid: $eid);
		$e->getEnrollmentByEid();
		if($this->isReviewed($e->uid,$e->cid)){
			$output=["Err"=>1,"Message"=>"该学测已被评阅"];
			echo(json_encode($output));
			return false;
		}
		$update=new Score(uid:$e->uid,cid:$e->cid,score: $score,reviewer: $uid);
		if($update->saveScore()){
			echo("Success");
		}
	}
}