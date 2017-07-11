<?php
namespace App\Http\Controllers\Sport;

header('Access-Control-Allow-Origin:*'); 
/*星号表示所有的域都可以接受，*/ 
header('Access-Control-Allow-Methods:GET,POST');  

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Sport\Register;

/*
*此控制器用来编写注册接口 提供注册数据
*@param $token 令牌 用来标识用户的参数
*@param $sign 签名 用来校验的接口参数 防止用户恶意访问
*/

class RegisterController extends Controller
{
	public function index()
	{
        $user_tel=Input::only('user_tel');
        $token=Input::get('token','');
        $sign=Input::get('sign','');
        $resign=md5(md5(md5('sizu1234')));
        //判断token sign参数设置
        $arr=[];
        if(empty($token)||empty($sign)){
            $arr['status']=1;
            $arr['message']="请求失败,token或sign参数未设置";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;exit;
        }
        //判断sign参数是否正确
        if($sign!=$resign){
            $arr['status']=2;
            $arr['message']="请求失败,sign参数错误";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;exit;
        }
        $model=new Register();
        $result=$model->getcheckphone($user_tel);
        if($result==0){
            $arr['status']=0;
            $arr['message']="请求成功222";
            $arr['result']=$result;

            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;die;
        }else if($result==1)
        {
            $arr['status']=9;
            $arr['message']="请求失败,用户已存在";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;
        }
    }





    public function register()
    {
        $post=Input::except('token','sign');
        $token=Input::get('token','');
        $sign=Input::get('sign','');
        $resign=md5(md5(md5('sizu1234')));
        // 0c35ef69f0e2975b76ddb33bad4084b0
        //判断token sign参数设置
        $arr=[];
        if(empty($token)||empty($sign)){
            $arr['status']=1;
            $arr['message']="请求失败,token或sign参数未设置";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;exit;
        }
        //判断sign参数是否正确
        if($sign!=$resign){
            $arr['status']=2;
            $arr['message']="请求失败,sign参数错误";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;exit;
        }
        $model=new Register();
        $data=$model->getregister($post);
        if($data){
            $arr['status']=0;
            $arr['message']="请求成功111";
            $arr['result']=$data;
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;die;
        }
    }

}