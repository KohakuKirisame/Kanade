<?php

namespace App\Http\Controllers;

use App\Models\Committee;

class CommitteeController extends Controller{
    public function getCommittees(){
        $coms=new Committee();
        $coms=$coms->getCommittees();
        return view("committee",["committees"=>$coms]);
    }
}

?>
