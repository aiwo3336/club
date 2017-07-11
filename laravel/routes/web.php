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
//##################俱乐部接口
Route::any('club', 'Sport\ClubController@index');
Route::any('createclub', 'Sport\CreateClubController@index');
Route::get('index', 'IndexController@index');
Route::get('add', 'IndexController@add');
Route::any('show', 'IndexController@show');
Route::any('upd', 'IndexController@upd');
Route::any('deletes', 'IndexController@deletes');

//健身知识接口
Route::any('blog','BlogController@index');
//健身知识详情接口
Route::any('blogone','BlogOneController@index');
//饮食推荐接口
Route::any('food','FoodController@index');
//饮食推荐详情接口
Route::any('foodone','FoodOneController@index');
//健身交流接口
Route::any('exchange','ExchangeController@index');
//健身交流详情接口
Route::any('exchangeone','ExchangeOneController@index');




//注册路由
Route::any('register/index','Sport\RegisterController@index');

//注册验证
Route::any('register','Sport\RegisterController@register');

//登录路由
Route::any('login','Sport\LoginController@login');

//修改密码路由
Route::any('newpwd','Sport\LoginController@newpwd');

//验证旧密码是否正确
Route::any('jiu','Sport\LoginController@jiu');

//查询个人详情
Route::any('details','Sport\DetailsController@details');

//添加个人详情
Route::any('man/insert','Sport\ManController@insert');

//修改个人详情
Route::any('myload','Sport\UploadController@myload');





















Route::get('index', 'IndexController@index');
//Route::get('user', 'UserController@index');
//Route::get('user/add', 'UserController@add');
//Route::post('user/adds', 'UserController@adds');
//Route::post('user/modify', 'UserController@modify');
//Route::get('user/del', 'UserController@del');
//Route::get('user/update', 'UserController@update');
