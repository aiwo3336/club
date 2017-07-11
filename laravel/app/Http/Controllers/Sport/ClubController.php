<?php
namespace App\Http\Controllers\Sport;
use App\Http\Controllers\Controller;
use App\Http\Model\Sport\Club;
use Illuminate\Support\Facades\Input;
/*
*此控制器用来编写俱乐部接口
*@param $token 令牌 用来标识用户的参数
*@param $sign 签名 用来校验的接口参数 防止用户恶意访问
*@param $callback 动态执行回调函数
*/
header('Access-Control-Allow-Origin:*');
/*星号表示所有的域都可以接受，*/
header('Access-Control-Allow-Methods:GET,POST');
class ClubController extends Controller
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
                $result = $this->post(Input::all());
                break;
            case 'put':
                $result = $this->put(Input::except('token','sign','action','callback'));
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
        $hot=isset($get['hot'])?$get['hot']:0;
        $sort=isset($get['sort'])?$get['sort']:0;
        $pages=isset($get['pages'])?$get['pages']:'';
        $club_id=isset($get['club_id'])&&is_numeric($get['club_id'])?$get['club_id']:'';
       // return array($pages);
        //查询热门
        if($hot==1){
            return $this->getHot();
        }
        if($sort==1){
            return $this->getSort($pages);
        }
        if(!empty($club_id)){
            return $this->getClubOne($club_id);
        }
    }
    public function post($post){
        $post['club_create'] = time();
        $post['club_update'] = time();
        $model = new Club();
        $res = $model -> clubPost($post);
        if($res){
            $arr['status'] = 0;
            $arr['message'] = "请求已提交,等待审核....";
        } else {
            $arr['status'] = 1;
            $arr['message'] = "请求异常,请稍后重试";
        }
        return $arr;
    }
    public function put($data){
        $arr=[];
        if(!empty($data['club_id'])&&is_numeric($data['club_id'])){
            $club=new Club();
            $res=$club->updateClub($data);
            if($res){
                $arr['error']=0;
                $arr['msg']='修改成功';
            }else{
                $arr['error']=1;
                $arr['msg']='修改失败';
            }
        }
        return $arr;
    }
    function getHot(){
        $club=new Club();
        $res=$club->getHotClub();
        if($res){
            $data['error']=0;
            $data['msg']='请求成功';
            $data['result']=$res;
        }else{
            $data['error']=1;
            $data['msg']='请求失败';
            $data['result']='';
        }
        return $data;
    }
    function getSort($pages){
        $club=new Club();
        $limit='';
        $pageSize='';
        if(!empty($pages)){
            $pages=($pages+3)/4;
            $pageSize=4;
            $limit=($pages-1)*$pageSize;
        }
        $res=$club->getSortClub($limit,$pageSize);
        if($res){
            $data['error']=0;
            $data['msg']='请求成功';
            $data['result']=$res;
        }else{
            $data['error']=1;
            $data['msg']='请求失败';
        }
        return $data;
    }
    function getClubOne($club_id){
        $model = new Club();
        $res = $model -> getClubId($club_id);
        if($res){
            $arr['error'] = 0;
            $arr['msg'] = "请求成功";
            $arr['result'] = $res;
        } else {
            $arr['error'] = 1;
            $arr['msg'] = "请求失败";
        }
        return $arr;
    }

}