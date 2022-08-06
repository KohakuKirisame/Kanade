<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seat extends Model{
	protected $table="seat";
	public $timestamps=false;
	
	public function __construct(array $attributes = [],$uid=0,$cid=0,$seat=""){
		parent::__construct($attributes);
		$this->uid=intval($uid);
		$this->cid=intval($cid);
		$this->seat=$seat;
	}
	
	public function getSeat(){
		$seat=DB::table("seat")->where("uid","=",$this->uid)->first();
		$this->cid=$seat->cid;
		$this->seat=$seat->seat;
		return $seat;
	}
	
	public function hasSeat(){
		$check=DB::table("seat")->where("uid","=",$this->uid)->exists();
		return $check;
	}
	
	public function changeSeat(){
		if($this->hasSeat()){
			$query=DB::table($this->table)->where("uid","=",$this->uid)->update(["cid"=>$this->cid,"seat"=>$this->seat]);
		}else{
			$query=DB::table($this->table)->insert(["uid"=>$this->uid,"cid"=>$this->cid,"seat"=>$this->seat]);
		}
		return $query;
	}
}
