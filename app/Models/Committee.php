<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Committee extends Model
{
    protected $table="committee";
    public $timestamps=false;

    public function getCommittees(){
        $committees=DB::table("committee")->get();
        $arr=array();
        foreach ($committees as $i){
            $arr[]=$i;
        }
        return $arr;
    }
}
