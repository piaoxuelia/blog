<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'IndexController@list');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/index/cates', 'IndexController@cates');

Route::get('/getHeader', function(){
	return response()
			->json([
		        'name' => 'Abigail', 
		        'state' => 'CA'
		]);
});
Route::get('/editor', 'EditorController@index')->name('editor');

Route::get('article/create', 'ArticleController@create');
Route::any('article/articles', 'ArticleController@list');
Route::post('article/store', 'ArticleController@store');
Route::post('article/store1', 'ArticleController@store1');
// Route::get('detail/{id}', function($para){

// 	return 'user '.$para;

// });
Route::get('detail/{id}', 'DetailController@showArticle')->name('articleid');;
Route::get('article/addcate', 'ArticleController@addcate');
Route::post('article/createcate', 'ArticleController@createcate');
Route::post('article/removecate', 'ArticleController@removecate');

// $uploadRoutes = $routeName = config('zhangmazi.ueditor.upload_routes_config_map');
// $routeName = Config::get('zhangmazi.ueditor.upload_route');
// $middleware=config('zhangmazi.ueditor.core.route.middleware');
// foreach($uploadRoutes as $routeName=>$configName){
//     Route::any($routeName,['middleware'=> $middleware,'uses'=>'Ender\UEditor\UEditorController@server']);
// }

//少个分号都不可以
//Route::get('/foo',function(){return 'hello world';});

//match
// Route::match(['get','post'],'/a',function(){
// 	return '123';
// });

// any
// Route::any('foo',function(){return 'foo';});
// 参数
// Route::get('user/{id}',function($para){return 'user '.$para;});
// 
// http://www.fetime.cc/posts/sd/comm/hello
// Route::get('posts/{post}/comm/{comm}',function($para1,$para2){
// 	return $para1.'&'.$para2;
// });
//可选路由参数
// Route::get('user/{name?}',function($para = null){
// 	return 'param is'.$para;
// });
// 默认参数
// Route::get('user/{name?}',function($para = 'lyy'){
// 	return 'param is '.$para;
// });
// 参数加正则
// Route::get('user/{name}',function($pram){return 'param is '.$pram;})->where('name','[A-Za-z]+');
// Route::get('user/{id}',function($parm){return 'param is id:'.$parm;})->where('id','[0-9]+');
// 
// http://www.fetime.cc/user/lyy/123
// Route::get('user/{name}/{id}',function($parm1,$parm2){
// 	return 'name is '.$parm1.', id is '.$parm2;
// })->where(['name'=>'[A-Za-z]+','id'=>'[0-9]+']);
// 
// id可以定义在 RouteServiceProvider.php的boot方法里，这样就不用给每一个有id的路由配置正则了：Route::pattern('id','[0-9]+');
// 
// Route::get('user/{name}/{id}',function($parm1,$parm2){
// 	return 'name is '.$parm1.', id is '.$parm2;
// })->where('name','[A-Za-z]+');
// 
// 命名路由可以方便的生成 URL 或者重定向到指定的路由
// Route::get('/user/{id}/profile',function($parm){
// 	return 'hello';
// })->name('profile');
//下面的重定向有点不明白
// $url = route('profile',['id'=>1]);
// return redirect()->route('profile');
// 
// 为控制器方法指定路由名称：
// Route::get('user/profile','UserController@showProfile')->name('profile');
// 
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/', function ()    {
//         // 使用 `Auth` 中间件
//     });

//     Route::get('user/profile', function () {
//         // 使用 `Auth` 中间件
//     });
// });
// Route::group(['namespace'=>'Admin'],function(){});
// 
// 路由前缀 http://www.fetime.cc/admin/user
// Route::group(['prefix'=>'admin'],function(){
// 	Route::get('user',function(){
// 		return 'admin/user';
// 	});
// });
// 
//当向路由控制器中注入模型 ID 时，我们通常需要查询这个 ID 对应的模型，Laravel 路由模型绑定提供了一个方便的方法自动将模型注入到我们的路由中，例如，除了注入一个用户的 ID，你也可以注入与指定 ID 匹配的完整 User 类实例。
// http://www.fetime.cc/api/users/1,1是数据库id这个字段的值  隐式绑定
// 如果你想要隐式模型绑定除 id 以外的数据库字段，你可以重写 Eloquent 模型类的 getRouteKeyName 方法
// 
// Route::get('api/users/{user}', function(App\User $user) {
//     return $user->email;
// });
// 
// 








