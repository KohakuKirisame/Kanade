<?php
namespace App\Http\Controllers;

use App\Models\Bill;

class BillController extends Controller{
	public function getBill($uid){
		return (new Bill())->getBill($uid);
	}
}