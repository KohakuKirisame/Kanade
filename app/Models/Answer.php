<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Answer extends Model{
    protected $table="answer";
	public $timestamps=false;
	
	public function getAnswer($uid,$qid=[]){
		foreach($qid as $item){
			if(!DB::table($this->table)->where(["uid"=>intval($uid),"qid"=>intval($item)])->exists()){
				DB::table($this->table)->insert(["uid"=>$uid,"qid"=>$item,"answer"=>""]);
			}
		}
		$answers=DB::table($this->table)->where("uid","=",$uid)->get();
		$arr=array();
		foreach($answers as $i){
			$arr[]=$i;
		}
		return $arr;
	}
	
	public function updateAnswer($uid,$data){
		foreach($data as $i){
			DB::table($this->table)->where(["uid"=>intval($uid),"qid"=>$i["qid"]])->update(["answer"=>$i["answer"],"update_time"=>date("Y-m-d H:i:s")]);
		}
		return true;
	}
}
