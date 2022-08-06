<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model{
    protected $table="question";
	public $timestamps=false;
	
	public function getQuestion($cid,$type){
		$questions=DB::table($this->table)->where(["cid"=>intval($cid),"type"=>intval($type)])->get();
		$arr=array();
		foreach($questions as $i){
			$arr[]=$i;
		}
		return $arr;
	}
}
