<?php 
namespace App\Http\Controllers\Sport;

header('Access-Control-Allow-Origin:*'); 
/*星号表示所有的域都可以接受，*/ 
header('Access-Control-Allow-Methods:GET,POST');

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Sport\Login;

/*
*此控制器用来编写用户登录接口 提供登录用户数据
*@param $token 令牌 用来标识用户的参数
*@param $sign 签名 用来校验的接口参数 防止用户恶意访问
*/
class LoginController extends Controller
{
	public function login()
	{
		$post=Input::all();
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
		$model=new Login();
		$result=$model->getcheckData($post);
		if(empty($result)){
			$arr['status']=1;
			$arr['message']="验证失败";
			$arr['result']="手机号或密码错误";
			$str=json_encode($arr,JSON_UNESCAPED_UNICODE);
			echo $str;exit;
		}else{
			$arr['status']=0;
			$arr['message']="验证成功";
			$arr['result']=$result;
			$str=json_encode($arr,JSON_UNESCAPED_UNICODE);
			echo $str;exit;			
		}
	}



    //修改密码
    public function newpwd(){
        $post=Input::all();
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
        $model=new Login();
        $result=$model->npwd($post);
        if(empty($result)){
            $arr['status']=1;
            $arr['message']="验证失败";
            $arr['result']="密码错误";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;exit;
        }else{
            $arr['status']=0;
            $arr['message']="验证成功";
            $arr['result']=$result;
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;exit;
        }
    }



    public function jiu()
    {
        $post=Input::all();
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
        $model=new Login();
        $result=$model->pan($post);
        if($result==1){
            $arr['status']=0;
            $arr['message']="密码存在";
            $arr['result']=$result;

            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;die;
        }else if($result==0)
        {
            $arr['status']=2;
            $arr['message']="失败,密码不存在";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;
        }
    }


}