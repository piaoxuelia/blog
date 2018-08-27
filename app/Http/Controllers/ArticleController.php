<?php

namespace App\Http\Controllers;

use Validator;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
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
	

	public function create()
	{	
		$Data=DB::table('categories')->get();
		return view('article.create', ['cates'=>$Data]);
	}

	public function store(Request $request)
	{
		

		// return redirect('article/article');
		$validator = Validator::make($request->all(), [
			'title' => 'required|max:255',
			'intro' => 'required|max:255',
			'content' => 'required|max:8000',
			'cover'=> 'required'
		]);

		// return var_dump($validator->fails());

		if ($validator->fails()) {
		 $this->setResult('failture','验证有误','',$validator->errors());
		   // return redirect('article/articles')
					//    ->withErrors($validator, 'article')
					//    ->withInput();
	   }
	   // insertGetId 返回存储后的id
	   // insert
	   // 
	   if(DB::table('articles')->insert([
			'title' => $request->get('title'),
			'intro' => $request->get('intro'),
			'content' => $request->get('content'),
			'cover' => $request->get('cover')
	   ])){
			return $this->setResult('success');
			return redirect('article/articles');
	   }else{
			return $this->setResult('failture','保存失败');
	   }
	}
	/**
	 * Create a new controller instance.
	 *
	 * @return response
	 */
	public function list()
	{
		
		$Data=DB::table('articles')->distinct()->get();
		//return $Data;
		return view('article/article',['articles'=>$Data]);
	}
	/**
	 * 添加分类同步数据
	 * @return response
	 */
	
	public function addcate()
	{
		$Data=DB::table('categories')->get();
		//return $Data;
		return view('article/addcate',['cates'=>$Data]);
	}

	/**
	 * 添加分类，异步添加
	 * @return response
	 */
	

	public function createcate(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'slug' => 'required|max:255',
		]);
		
		 if ($validator->fails()) {
			return $this->setResult('failture','验证有误','',$validator->errors());
		 }

		$name =  $request->input('name');
		$slug =  $request->input('slug');

		$categories = DB::table('categories') 
				->where('name', '=', $name)
				->get();

		if(count($categories) > 0){ //如果原来有重复的，则不再添加到数据库
			return $this->setResult('failture','已有相同的分类~');
		}else{
			$id = DB::table('categories')->insertGetId(['name' => $name,'slug' => $slug]);
			if(!empty($id)){
				return $this->setResult('success','',['id'=>$id]);
			}else {
				return $this->setResult('failture','保存失败');
			}
		}
	}
	/**
	* 删除-条分类数据
	 * @return array
	 */
	public function removecate(Request $request)
	{

		$id =  $request->input('id');
		$slug =  $request->input('slug');

		if( DB::table('categories') ->where('id', '=', $id) ->delete() > 0){
			return $this->setResult('success','',['id'=>$id]);
		}else{
			return $this->setResult('failture','删除失败');
		}
		
	}

	/**
	* 规范化返回数据
	 * @return array
	 */
	protected function setResult($status='failture', $msg = '',$data = null, $errors = null)
	{
		return [
			'status' => $status,  //最后处理状态, success=成功, failture=失败
			'msg' => $msg,
			'data' => $data,
			'errors'=>$errors
		];
	}

	public function store1(Request $request){
		// return redirect('article/article');
		$validator = Validator::make($request->all(), [
			'title' => 'required|max:255',
			'intro' => 'required|max:255',
			'content' => 'required|max:8000',
			'cover'=> 'required'
		]);

		// return var_dump($validator->fails());

		if ($validator->fails()) {
		 $this->setResult('failture','验证有误','',$validator->errors());
	   }
	   // insertGetId 返回存储后的id
	   // insert
	   // 
	  //  if(DB::table('articles')->insert([
			// 'title' => $request->get('title'),
			// 'intro' => $request->get('intro'),
			// 'content' => $request->get('content'),
			// 'cover' => $request->get('cover')
	  //  ])){
			// return $this->setResult('success');
			// return redirect('article/articles');
	  //  }else{
			// return $this->setResult('failture','保存失败');
	  //  }

		$article = new Article;
		$article->title = $request->get('title');
		$article->intro = $request->get('intro');
		$article->content = $request->get('content');
		$article->cover = $request->get('cover');
		$article->user_id = Auth::id();

		if($article->save()){
			return $this->setResult('success');
		}else{
			return $this->setResult('failture','保存失败');
		}
	}

}
