<?php
namespace App\Http\Controllers\Sport;

header('Access-Control-Allow-Origin:*');
/*星号表示所有的域都可以接受，*/
header('Access-Control-Allow-Methods:GET,POST');

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Sport\Details;

/*
*此控制器用来展示用户详情
*/
class DetailsController extends Controller
{
    public function details()
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
        $model=new Details();
        $result=$model->detailsselect($post);
        $result= json_decode(json_encode($result),true);
        if($result==1)
        {
            $arr['status']=9;
            $arr['message']="数据为空";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo $str;
        }else{
                $arr['status']=0;
                $arr['message']="请求成功222";
                $arr['result']=$result;
                $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
                echo $str;
            }
    }

}