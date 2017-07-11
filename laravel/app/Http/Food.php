<?php 

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理城市接口数据
*/
class Food extends Model
{

    protected $table='food';
    protected $primaryKey='food_id';
    public $timestamps=false;
    protected $fillable = [
        'food_title',
        'food_img',
        'food_content',
        'food_time',
    ];
    protected $hidden=[

    ];    
	//查询全部：
	public function getfood($limit,$pageSize)
	{
        if(!empty($pageSize)){
            return $this
                ->orderBy('food_id','desc')
                ->offset($limit)
                ->limit($pageSize)
                ->get();
        }else{
            return $this
                ->orderBy('food_id','desc')
                ->get();
        }
	}

}