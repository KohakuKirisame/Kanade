<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill extends Model{
	protected $table="bill";
	public $timestamps=false;
	
	public function creatBill($uid,$name,$cost){
		$resault=DB::table($this->table)->insert(["uid"=>intval($uid),"name"=>$name,"cost"=>floatval($cost),"purchased"=>0]);
		return $resault;
	}
	
	public function getBill($uid){
		$bills=DB::table($this->table)->where("uid","=",intval($uid))->orderBy("bid")->get();
		$arr=[];
		foreach($bills as $bill){
			$arr[]=$bill;
		}
		return $arr;
	}
	
	public function quit($uid){
		$bills=DB::table($this->table)->where("uid","=",intval($uid))->delete();
		return $bills;
	}
}