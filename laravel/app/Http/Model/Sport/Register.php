<?php
namespace App\Http\Model\Sport;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * 此model层用来处理城市接口数据
 */
class Register extends Model
{
    public function getcheckphone($user_tel)
    {
        $res=DB::table('user')->where('user_tel',$user_tel)->first();
        if($res){
            return "1";
        }else{
            return "0";
        }
    }
    public function getregister($post)
    {
        $str='abcdefghijklmnopqrstuvwxyz0123456789';
        $post['token']=substr(str_shuffle($str).time(),-15,15).$post['user_tel'];
        $user_pwd=$post['user_pwd'];
        $post['user_pwd']=md5($user_pwd);
        $arr=[];
        $arr['token']=$post['user_pwd'];
        $user_id=DB::table('user')->InsertGetId($post);
        $arr['token']=DB::table('user')->select('token')->where('user_id',$user_id)->first();
        return $arr;
    }



}