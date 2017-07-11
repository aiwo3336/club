<?php 

namespace App\Http\Model\Sport;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理用户登录
*/
class Login extends Model
{



    //登陆
	public function getcheckData($post)
	{
		$user_tel=$post['user_tel'];
		$user_pwd=md5($post['user_pwd']);
		$res=DB::select("select user_id,token from sport_user where user_tel='$user_tel' and user_pwd='$user_pwd'");
		return $res;
	}


    //判断旧密码
    public function pan($post){
        unset($post['token']);
        unset($post['sign']);
        $pwd=md5($post['j_pwd']);
        $res=DB::table('user')->where(['user_pwd'=>$pwd])->first();
        if($res){
            return "1";
        }else{
            return "0";
        }
    }


    //修改密码
    public function npwd($post){
        $token=$post['token'];
        unset($post['token']);
        unset($post['sign']);
        $post['user_pwd']=md5($post['user_pwd']);
        $res=DB::table('user')->where(['token'=>$token])->update($post);
        return $res;

    }



}