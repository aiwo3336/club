<?php
namespace App\Http\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
   // protected $table = "club";
//    protected $primaryKey='id';//修改主键
//    protected $hidden=[];//隐藏敏感字段
//
//    public  function post($aa){
//        $re = DB::table('order')->insert($aa);
//        return $re;
//    }
    public  function  get($hot){
        $re = DB::table('club')->select('club_id','club_name','club_img','club_intro')->where('is_hot', '1')->get();
        return $re;
    }
    //俱乐部介绍
    public  function  add($club_id){
        $re = DB::table('club')->select('club_contents')->where('club_id',$club_id)->first();
        return $re;
    }
    //俱乐部相册
    public  function  show($club_id){
        $re = DB::table('photo')->select('photo_img')->where('club_id',$club_id)->get();
        return $re;
    }
    //俱乐部教练
    public  function  upd($club_id){
        $re = DB::table('coach')->where('club_id',$club_id)->get();
        return $re;
    }
    //模糊查询
    public  function  deletes($data){
        $re = DB::table('club')->where('club_name','like',"%$data%")->get();
        return $re;
    }
//    public  function  deletes($id){
//        //return $this->find($id)->delete();
//        $re = DB::table('order')
//            ->where('order_id', $id)
//            ->delete();
//        return $re;
//    }
//    public  function  updates($id,$arr){
//        $re = DB::table('order')
//            ->where('order_id', '=', $id)
//            ->update($arr);
//        return $re;
//    }

}

