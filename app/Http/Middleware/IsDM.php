<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class IsDM{
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next){
		if($request->session()->missing("uid")){
			return redirect("/");
		}
		$uid = $request->session()->get("uid");
		$check = new Admin();
		$check = $check->isDM($uid);
		if(!$check){
			return redirect("/");
		}
		return $next($request);
	}
}
