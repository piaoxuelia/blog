<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DetailController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	

	public function showArticle($articleid)
	{	

		if(!empty($articleid)){
			$data = DB::table('articles')->where('id','=',$articleid)->get();

			// return $data;
			if(count($data) > 0){
				$userinfo= DB::table('users')->where('id','=', $data[0]->user_id)->get();
				if(!empty($data[0]->updated_at)){
					$date = date_create($data[0]->updated_at);
					$data[0]->updated_at = date_format($date,"Y/m/d");
				}
				

				if(!empty($data[0]->user_id)){
					$userinfo= DB::table('users')->where('id','=', $data[0]->user_id)->get();
					$data[0]->username = $userinfo[0]->name;
				}

				return view('detail',['article'=>$data]);
			}else{
				abort(404, '很抱歉，页面找不到了。');
			}
		}
	}
}
