<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Enrollment;

class ConferenceController extends Controller{
	public function getTime($uid){
		$enroll=(new Enrollment(uid:$uid))->enrollmentInfo();
		$type=intval($enroll->type);
		return (new Conference())->getTime($type);
	}
	
	public function getTimeByType($type){
		return (new Conference())->getTime(intval($type));
	}
	
	public function getPaymentInfo(){
		return (new Conference())->getPaymentInfo();
	}
	
	public function getConferenceInfo(){
		return (new Conference())->getConferenceInfo();
	}
}