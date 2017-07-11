<?php 

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理城市接口数据
*/
class FoodOne extends Model
{
	public function getfoodone($food_id)
	{
        return DB::table('food')->where('food_id',$food_id)->first();
	}
}