<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Seat extends Model{
	protected $table="seat";
	public $timestamps=false;
	
	public function getSeat($uid){
		$seat=DB::table("seat")->where("uid","=",intval($uid))->get(["cid","seat"]);
		return $seat;
	}
}
