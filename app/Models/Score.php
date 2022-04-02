<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Score extends Model{
	protected $table="score";
	public $timestamps=false;
	
	public function getScore($uid){
		$score=DB::table("score")->where("uid","=",intval($uid))->get(["cid","score"]);
		return $score;
	}
}
