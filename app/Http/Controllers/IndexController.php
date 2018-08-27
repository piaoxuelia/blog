<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
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
	

	public function list()
	{	
		$cates=DB::table('categories')->get();
		$data = DB::table('articles')->orderBy('updated_at', 'desc')->get();
		// return $data;
		if(count($data) > 0){
			foreach ($data as $d) {
				if(!empty($d->user_id)){
					$userinfo= DB::table('users')->where('id','=', $d->user_id)->get();
					$d->username = $userinfo[0]->name;
					$date = date_create($d->updated_at);
					$d->updated_at = date_format($date,"Y/m/d");

				}
			}
			return view('index',['lists'=>$data, 'cates'=>$cates]);
		}else{
			abort(404, '很抱歉，页面找不到了。');
		}
		
	}
	public function cates(Request $request)
	{	
		$cates=DB::table('categories')->get();
		$cover= $request->get('id');
		// return $cover;
		if($cover < 0){//全部文章
			$data = DB::table('articles')->orderBy('updated_at', 'desc')->get();
		}else{//分类文章
			$data = DB::select( DB::raw("SELECT * FROM articles WHERE find_in_set('$cover',cover) ORDER BY updated_at DESC"), array(
			   'cover' => $cover,
			 ));
		}
		if(count($data) > 0){
			foreach ($data as $d) {
				if(!empty($d->user_id)){
					$userinfo= DB::table('users')->where('id','=', $d->user_id)->get();
					$d->username = $userinfo[0]->name;
					$date = date_create($d->updated_at);
					$d->updated_at = date_format($date,"Y/m/d");
				}
			}
			return ['lists'=>$data];
		}else{
			return [];
		}
		
	}

}
