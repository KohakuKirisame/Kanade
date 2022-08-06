<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conference extends Model{
	public $timestamps=false;
	protected $table="conference";
	
	public function getTime($type){
		if($type>=2){
			$start=DB::table($this->table)->where("key","=","start_aca")->first();
			$ddl=DB::table($this->table)->where("key","=","ddl_aca")->first();
		}else{
			$start=DB::table($this->table)->where("key","=","start_del")->first();
			$ddl=DB::table($this->table)->where("key","=","ddl_del")->first();
		}
		return [$start->value,$ddl->value];
	}
	
	public function getCost($type){
		if($type==0){
			$cost=DB::table($this->table)->where("key","=","cost_del")->first()->value;
		}else{
			$cost=DB::table($this->table)->where("key","=","cost_obs")->first()->value;
		}
		$accommodation=DB::table($this->table)->where("key","=","accommodation")->first()->value;
		return [floatval($cost),floatval($accommodation)];
	}
	
	public function getPaymentInfo(){
		$name=DB::table($this->table)->where("key","=","account_name")->first()->value;
		$number=DB::table($this->table)->where("key","=","account_num")->first()->value;
		$bank=DB::table($this->table)->where("key","=","account_bank")->first()->value;
		return [$name,$number,$bank];
	}
	
	public function getConferenceInfo(){
		$name=DB::table($this->table)->where(["key"=>"name"])->first()->value;
		$name_en=DB::table($this->table)->where(["key"=>"name_en"])->first()->value;
		$name_short=DB::table($this->table)->where(["key"=>"name_short"])->first()->value;
		$position=DB::table($this->table)->where(["key"=>"position"])->first()->value;
		$time_start=DB::table($this->table)->where(["key"=>"time_start"])->first()->value;
		$time_end=DB::table($this->table)->where(["key"=>"time_end"])->first()->value;
		$qq_group=DB::table($this->table)->where(["key"=>"qq_group"])->first()->value;
		$head=explode(",",DB::table($this->table)->where(["key"=>"head"])->first()->value);
		$contact=explode(",",DB::table($this->table)->where(["key"=>"contact"])->first()->value);
		return [$name,$name_en,$name_short,$time_start,$time_end,$position,$qq_group,$head,$contact];
	}
}