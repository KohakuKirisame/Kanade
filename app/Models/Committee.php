<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Committee extends Model{
	protected $table = "committee";
	public $timestamps = false;
	
	public function getCommittees(){
		$committees = DB::table("committee")->get();
		$arr = array();
		foreach($committees as $i){
			$arr[] = $i;
		}
		return $arr;
	}
	
	public function getCommitteeInfo($cid){
		$committee = DB::table("committee")->where("cid","=",intval($cid))->first();
		return $committee;
	}
	
	public function updateCommittee($cid = 114514, $committee = "114514", $topic = "114514", $dh = [], $dm = [], $ad = [], $rule = "114514", $delegate = "114514", $time = "114514", $introduction = "114514"){
		if(DB::table("committee")->where("cid", "=", $cid)->exists()){
			$query = DB::table("committee")->where("cid", "=", $cid)->update(["
                committee" => $committee,
				"topic" => $topic,
				"dh" => implode(",", $dh),
				"ad" => implode(",", $ad),
				"dm" => implode(",", $dm),
				"rule" => $rule,
				"delegate" => $delegate,
				"time" => $time,
				"introduction" => $introduction]);
		}else{
			$query = DB::table("committee")->insert([
				"committee" => $committee,
				"topic" => $topic,
				"dh" => implode(",", $dh),
				"ad" => implode(",", $ad),
				"dm" => implode(",", $dm),
				"rule" => $rule,
				"delegate" => $delegate,
				"time" => $time,
				"introduction" => $introduction]);
		}
		return $query;
	}
}