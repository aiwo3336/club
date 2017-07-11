<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Model\Index;

class IndexController extends Controller
{

    public  function  indexs()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $sex = isset($_GET['sex']) ? $_GET['sex'] : '';
        $age = isset($_GET['age']) ? $_GET['age'] : '';
        $hobby = isset($_GET['hobby']) ? $_GET['hobby'] : '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        //验证非空
        if (empty($action)) {
            echo json_encode(array('status' => '3', 'message' => 'error'));
            die;
        }
//     //验证规则
//     if($sign != md5($action.$time)){
//         echo  json_encode(array('status'=>'2','message'=>'error'));die;
//     }
        switch ($action) {
            case 'get':
                return $this->get();
                break;
            case 'delete':
                return $this->delete($id);
                break;
            case 'post':
                return $this->post($name,$sex,$age,$hobby);
                break;
            case 'put':
                return $this->put($name,$sex,$age,$hobby,$id);
                break;
            default:
                $action = array('status' => '0', 'message' => 'error,操作错误');
                break;
        }
    }

    //根据热词查找
    public  function  index()
    {
     $hot= $_GET['callback'];
        $index =  new Index();
       $data= $index->get($hot);
        $result=array('status' => '1', 'message' => 'OK','data'=>$data);
        $str = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo "data($str)";
    }
    //俱乐部介绍
    public  function  add(){
       $club_id= $_GET['club_id'];
//        $club_id=3;
        $index =  new Index();
        $data= $index->add($club_id);
        $result=array('status' => '1', 'message' => 'OK','data'=>$data);
        $str = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo "data($str)";
    }
    //俱乐部相册
    public  function  show(){
        $club_id= $_GET['club_id'];
//        $club_id=3;
        $index =  new Index();
        $data= $index->show($club_id);
        $result=array('status' => '1', 'message' => 'OK','data'=>$data);
        $str = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo "data($str)";
    }
    //俱乐部教练
    public  function  upd(){
        $club_id= $_GET['club_id'];
//        $club_id=3;
        $index =  new Index();
        $data= $index->upd($club_id);
        $result=array('status' => '1', 'message' => 'OK','data'=>$data);
        $str = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo "data($str)";
    }
    //模糊查询
    public  function  deletes(){
        $datas=trim($_GET['data']);
//        $datas='健身';
        $index =  new Index();
        $data= $index->deletes($datas);
        $result=array('status' => '1', 'message' => 'OK','data'=>$data);
        $str = json_encode($result, JSON_UNESCAPED_UNICODE);
        echo "data($str)";
    }


}