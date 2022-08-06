<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\http\Request;

class CommitteeController extends Controller{
    public function getCommitteeInfo($cid){
        $coms = new Committee();
        $com = $coms->getCommitteeInfo($cid);
        return $com;
    }
    
    public function updateCommittee(Request $request){
        $data = $request->input();
        $com = new Committee();
        $com = $com->updateCommittee($data["cid"], $data["committee"], $data["topic"], $data["dh"], $data["dm"], $data["ad"], $data["rule"], $data["delegate"], $data["time"], $data["introduction"]);
        return $com;
    }
    
    public function getStaff($cid){
        $info=$this->getCommitteeInfo($cid);
        $dh=explode(",",$info->dh);
        $ad=explode(",",$info->ad);
        $dm=explode(",",$info->dm);
        $output=[[],[],[]];
        $personInfo=(new OAuthController())->GetInfo($dh);
        $output[0]=$personInfo;
        foreach($ad as $i){
            $personInfo=(new OAuthController())->GetInfo($i);
            $output[1][]=$personInfo;
        }
        $personInfo=(new OAuthController())->GetInfo($dm);
        $output[2]=$personInfo;
        return $output;
    }
    
    public function getCommittees(){
        $coms = new Committee();
        $coms = $coms->getCommittees();
        $staff=[];
        foreach($coms as $com){
            $staff[]=$this->getStaff($com->cid);
        }
        return ["committees"=>$coms,"staff"=>$staff];
    }
}
?>
