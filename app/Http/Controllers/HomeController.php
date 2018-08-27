<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $u_id = Auth::id();
        $data = DB::select( DB::raw("SELECT * FROM articles WHERE find_in_set('$u_id',user_id)"), array(
           'u_id' => $u_id,
         ));
        
        // return $data;
        if(count($data) > 0){
            foreach ($data as $d) {
                if(!empty($d->user_id)){
                    $userinfo= DB::table('users')->where('id','=', $d->user_id)->get();
                    $d->username = $userinfo[0]->name;
                }
            }
            return view('home',['lists'=>$data]);
        }else{
            return view('home',['lists'=>'[]']);
        }
    }

    
}
