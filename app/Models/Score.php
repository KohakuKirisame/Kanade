<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Score extends Model{
	protected $table="score";
	public $timestamps=false;
	
	public function __construct(array $attributes = [],$uid=0,$cid=0,$score=0.0,$reviewer=0){
		parent::__construct($attributes);
		$this->uid=intval($uid);
		$this->cid=intval($cid);
		$this->score=floatval($score);
		$this->reviewer=intval($reviewer);
	}
	
	public function getScore(){
		$score=DB::table($this->table)->where("uid","=",$this->uid)->first();
		$this->cid=$score->cid;
		$this->score=$score->score;
		$this->reviewer=$score->reviewer;
		return $score;
	}
	
	public function isReviewed(){
		$check=DB::table("score")->where(["uid"=>$this->uid,"cid"=>$this->cid])->exists();
		return $check;
	}
	
	public function saveScore(){
		$update=DB::table($this->table)->insert(["uid"=>$this->uid,"cid"=>$this->cid,"score"=>$this->score,"reviewer"=>$this->reviewer]);
		if($update){
			return true;
		}else{
			return false;
		}
	}
	
	public function getScored($cid=0){
		if($cid!=0){
			$data=DB::table($this->table)->where("cid","=",intval($cid))->get()->map(function ($value){return (array)$value;})->toArray();
		}else{
			$data=DB::table($this->table)->get()->map(function ($value){return (array)$value;})->toArray();
		}
		return $data;
	}
}
