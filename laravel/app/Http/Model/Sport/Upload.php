<?php 

namespace App\Http\Model\Sport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
/**
* 此model层用来修改个人资料
*/
class Upload extends Model
{


   //修改个人信息
    public function upd($post){

        $token=$post['token'];
        unset($post['token']);
        unset($post['sign']);
        return  DB::table('detail')->where(['token'=>$token])->update($post);

    }











}
