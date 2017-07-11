<?php 

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理城市接口数据
*/
class BlogOne extends Model
{
	public function getinfo($blog_id)
	{
        return DB::table('blog')->where('blog_id',$blog_id)->first();
	}
}