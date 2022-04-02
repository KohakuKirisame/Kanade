<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Committee;

class ScoreController extends Controller{
	public function getScore(Request $request){
		$uid=$request->input("uid");
		$score=new Score();
		$score=$score->getScore($uid);
		$com=new Committee();
		$com=$com->getCommitteeInfo($score->cid);
		$data=array($com,$score->score);
		return $data;
	}
}
