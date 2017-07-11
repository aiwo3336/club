<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Food;
/*
*此控制器用来编写健身知识接口 提供健身知识数据
*@param $token 令牌 用来标识用户的参数
*@param $sign 签名 用来校验的接口参数 防止用户恶意访问
*@param $callback 动态执行回调函数
*/

class FoodController extends Controller
{
    public function index()
    {
        $callback = Input::get('callback');
        $token = Input::get('token', '');
        $sign = Input::get('sign', '');
        $action = Input::get('action','get');

        $resign=md5(md5(md5('sizu1234')));
        //判断token sign参数设置
        if(empty($token)||empty($sign)){
            $arr['status']=1;
            $arr['message']="请求失败,token或sign参数未设置";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo "$callback($str)";exit;
        }
        //判断sign参数是否正确
        if($sign!=$resign){
            $arr['status']=2;
            $arr['message']="请求失败,sign参数错误";
            $str=json_encode($arr,JSON_UNESCAPED_UNICODE);
            echo "$callback($str)";exit;
        }
        switch ($action) {
            case 'get':
                $result = $this->get(Input::get());
                break;
            case 'post':
                $result = $this->post();
                break;
            case 'put':
                $result = $this->put();
                break;
            case 'delete':
                $result = $this->delete();
                break;
            default:
                $result = $this->get(Input::get());
                break;
        }
        $str = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo "$callback($str)";
        exit;

    }
    public function get($get){
            $pages=isset($get['pages'])?$get['pages']:'';
            $limit='';
            $pageSize='';
            if(!empty($pages)){
                $pages=($pages+3)/4;
                $pageSize=4;
                $limit=($pages-1)*$pageSize;
            }
        $arr=[];
        //验证通过 通过model层查询健身知识
        $model=new Food();
        $result=$model->getfood($limit,$pageSize);
        // echo "<pre>";
        // print_r($result);die;
        if(empty($result)){
            $arr['status']=1;
            $arr['message']='查询失败';
            $arr['result']='参数无效';
        }else{
            $arr['status']=0;
            $arr['message']='查询成功';
            $arr['result']=$result;     
        }
        return $arr;
    }

}