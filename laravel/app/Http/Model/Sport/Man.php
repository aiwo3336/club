<?php 

namespace App\Http\Model\Sport;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
/**
* 此model层用来修改个人资料
*/
class Man extends Model
{
    //添加
    public function editPeople($post){
        unset($post['sign']);
        return DB::table('detail')->insert($post);
    }












}
