<?php 

namespace App\Http\Model\Sport;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理用户登录
*/
class Details extends Model
{
	
	public function detailsselect($post)
	{
        $token=$post['token'];
        $res=DB::table('detail')->where(['token'=>$token])->first();
        if($res){
            return $res;
        }else{
            return "1";
        }
	}
}