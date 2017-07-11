<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
	public function index()
	{
		$data = DB::table('user')->get();
        return view('user.index', ['data' => $data]);
	}
	public function add()
	{
		return view('user.add');
	}	
	public function adds()
	{
		$post=Input::all();
		$name=$post['name'];
		$sex=$post['sex'];
		$age=$post['age'];
		$re=DB::insert('insert into user (name,sex,age) values(?,?,?)',["$name","$sex",$age]);
		return redirect()->action('UserController@index');
	}
	public function del()
	{
		$id = Input::get('id');
		$re=DB::delete("delete from user where id= :id",['id'=>$id]);
		if($re){
			return redirect()->action('UserController@index');
		}
	}
	public function update()
	{
		$id=Input::get('id');
		$data = DB::table('user')->where('id', $id)->first();
		// print_r($data);die;
        return view('user.update',['data'=>$data]);
	}
	public function modify()
	{
		$post=Input::all();
		$name=$post['name']?$post['name']:'';
		$sex=$post['sex']?$post['sex']:'';
		$age=$post['age']?$post['age']:'';
		$id=$post['id']?$post['id']:'';
		$re=DB::update("update user set name='$name',sex='$sex',age='$age' where id= ?",[$id]);
		if($re){
			return redirect()->action("UserController@index");
		}
	}
}