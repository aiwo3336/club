<?php 

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理城市接口数据
*/
class ExchangeOne extends Model
{
	public function getexchangeOne($exchange_id)
	{
        return DB::table('exchange')->where('exchange_id',$exchange_id)->first();
	}
}