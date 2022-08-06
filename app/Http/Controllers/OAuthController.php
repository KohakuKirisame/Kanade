<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OAuthController extends Controller{
	public function Auth(Request $request){
		if($request->session()->exists("uid")){
			return redirect("/");
		}
		$code=$request->input("code");
		$data=http_build_query(["f"=>"oauth_token","code"=>$code]);
		$options = array('http' => array(
			'method' => 'POST',
			'header' => 'Content-type:application/x-www-form-urlencoded',
			'content' => $data,
			'timeout' => 15 * 60
		));
		$context=stream_context_create($options);
		$result=file_get_contents($_ENV["Reimu_Url"]."/includes/query.php", false, $context);
		$result=json_decode($result,true);
		if(key_exists("err",$result)){
			return view("login_failed");
		}else{
			$request->session()->put(["uid"=>intval($result["uid"]),"token"=>$result["token"],"valid"=>time()+43200]);
			return redirect("/");
		}
	}
	
	public function LogOut(Request $request){
		$request->session()->flush();
		return redirect("/");
	}
	
	public function IsAuthed(Request $request){
		if($request->session()->exists(["uid","token"])){
			return true;
		}else{
			return false;
		}
	}
	
	public function GetInfo($uid_search){
		ini_set("allow_url_fopen","On");
		$uid=Session::get("uid");
		$token=Session::get("token");
		if(gettype($uid_search)=="integer"){
			$search=json_encode(array($uid_search));
		}elseif(gettype($uid_search)=="string"){
			$search=json_encode(array(intval($uid_search)));
		}elseif(gettype($uid_search)=="array"){
			$search=json_encode($uid_search);
		}
		
		$data=http_build_query(["f"=>"InfoJson","uid"=>$uid,"token"=>$token,"uid_search"=>$search]);
		$options = array('http' => array(
			'method' => 'POST',
			'header' => 'Content-type:application/x-www-form-urlencoded',
			'content' => $data,
			'timeout' => 15 * 60,
			''
		));
		$context=stream_context_create($options);
		$result=file_get_contents($_ENV["Reimu_Url"]."/includes/query.php", false, $context);
		$result=json_decode($result,associative: true);
		return $result;
	}
	
}
