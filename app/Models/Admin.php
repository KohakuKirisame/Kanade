<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model{
	protected $table = "admin";
	public $timestamps = false;
	
	public function __construct(array $attributes = [],$uid=0,$permission=2,$cid=[]){
		parent::__construct($attributes);
		$this->uid=$uid;
		$this->permission=$permission;
		$this->cid=$cid;
	}
	
	public function isSupAdmin($uid){
		$check = DB::table("admin")->where("uid", "=", intval($uid))->where("permission", "=", 0)->exists();
		return $check;
	}
	
	public function isDH($uid){
		$check = DB::table("admin")->where("uid", "=", intval($uid))->where("permission", "<=", 1)->exists();
		return $check;
	}
	
	public function isDM($uid){
		$check = DB::table("admin")->where("uid", "=", intval($uid))->where("permission", "<=", 2)->exists();
		return $check;
	}
	
	public function getAdminInfo(){
		$info=DB::table($this->table)->where("uid","=",$this->uid)->first();
		$info=get_object_vars($info);
		$this->permission=intval($info["permission"]);
		$this->cid=array_map(function ($v){return intval($v);},explode(",",$info["cid"]));
	}
}
