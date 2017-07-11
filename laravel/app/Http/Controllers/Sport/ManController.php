<?php

namespace App\Http\Controllers\Sport;
header('Access-Control-Allow-Origin:*');
/*星号表示所有的域都可以接受，*/
header('Access-Control-Allow-Methods:GET,POST');

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Sport\Man;

/*
*此控制器用来编写注册接口 提供注册数据
*@param $token 令牌 用来标识用户的参数
*@param $sign 签名 用来校验的接口参数 防止用户恶意访问
*/

class ManController extends Controller
{

    public function insert()
    {
        $post=Input::all();
        $file=Input::file('detail_img');
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

        $arr=$this->upimg($post,$file);
        return $arr;
    }



    public function upimg($post,$file){
        $path=$this->uploadFiles($file);
        $post['detail_img']=$path;
        $man=new Man();
        if($man->editPeople($post)){
            $arr['status']=0;
            $arr['message']='添加成功';
        }else{
            $arr['status']=1;
            $arr['message']='添加失败';
        }
        return $arr;
    }
    public function uploadFiles($file){
        if($file -> isValid()){
            //检验一下上传的文件是否有效.
            $clientName = $file -> getClientOriginalName();
            $extension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = md5(date('ymdhis').$clientName).".".$extension;
            $file -> move('uploads/images/',$newName);
            return 'uploads/images/'.$newName;

        }

    }

}