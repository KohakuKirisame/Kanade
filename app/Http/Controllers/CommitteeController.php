<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use Illuminate\http\Request;

class CommitteeController extends Controller{
    public function getCommittees(){
        $coms = new Committee();
        $coms = $coms->getCommittees();
        return view("committee", ["committees" => $coms]);
    }
    
    public function updateCommittee(Request $request){
        $data = $request->input();
        $com = new Committee();
        $com = $com->updateCommittee($data["cid"], $data["committee"], $data["topic"], $data["dh"], $data["dm"], $data["ad"], $data["rule"], $data["delegate"], $data["time"], $data["introduction"]);
        return $com;
    }
}
?>
