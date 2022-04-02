<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model{
	protected $table = "admin";
	public $timestamps = false;
	
	public function isSupAdmin($uid){
		$check = DB::table("admin")->where("uid", "=", intval($uid))->where("permission", "=", 1)->exists();
		return $check;
	}
}
