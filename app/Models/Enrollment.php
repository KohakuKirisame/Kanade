<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Enrollment extends Model{
	protected $table="enrollment";
	public $timestamps = false;
	
	public function __construct(array $attributes = [],$eid=0,$uid=0,$type=0,$cid=0,$invitation_code=""){
		parent::__construct($attributes);
		$this->eid=$eid;
		$this->uid=$uid;
		$this->type=$type;
		$this->cid=$cid;
		$this->invitation_code=$invitation_code;
	}
	
	public function isEnrolled(){
		if(DB::table($this->table)->where(["uid"=>intval($this->uid),"status"=>1])->exists()){
			return true;
		}else{
			return false;
		}
	}
	
	public function enrollmentInfo(){
		if($this->isEnrolled()){
			$info=DB::table($this->table)->where(["uid"=>intval($this->uid),"status"=>1])->first();
			return $info;
		}else{
			return false;
		}
	}
	
	public function enroll($uid,$type,$invitation_code,$cid){
		$enroll=DB::table($this->table)->insert(["uid"=>intval($uid),"type"=>intval($type),"invitation_code"=>$invitation_code,"cid"=>intval($cid),"status"=>1]);
		return $enroll;
	}
	
	public function quit(){
		$quit=DB::table($this->table)->where(["uid"=>intval($this->uid),"status"=>1])->update(["status"=>0]);
	}
	
	public function getEnrollmentByCid($type){
		$info=DB::table($this->table)->where(["cid"=>$this->cid,"status"=>1])->where("type","<=",intval($type))->get()->map(function ($value){return (array)$value;})->toArray();
		return $info;
	}
	
	public  function getEnrollmentByEid(){
		$info=DB::table($this->table)->where(["eid"=>intval($this->eid)])->first();
		$this->uid=$info->uid;
		$this->type=$info->type;
		$this->cid=$info->cid;
		$this->invitation_code=$info->invitation_code;
		return get_object_vars($info);
	}
}
