<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Committee;

class SeatController extends Controller{
	public function getSeat(Request $request){
		$uid=$request->input("uid");
		$seat=new Seat();
		$seat=$seat->getSeat($uid);
		$com=new Committee();
		$com=$com->getCommitteeInfo($seat->cid);
		$data=array($com,$seat->seat);
		
	}
}
