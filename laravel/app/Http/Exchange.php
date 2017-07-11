<?php 

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理城市接口数据
*/
class Exchange extends Model
{

    protected $table='exchange';
    protected $primaryKey='exchange_id';
    public $timestamps=false;
    protected $fillable = [
        'exchange_title',
        'exchange_img',
        'token',
        'exchange_content',
        'exchange_time',
    ];
    protected $hidden=[

    ];    
	//查询分页：
	public function getexchange($limit,$pageSize)
	{
        if(!empty($pageSize)){
            return $this
                ->orderBy('exchange_time','desc')
                ->offset($limit)
                ->limit($pageSize)
                ->get();
        }else{
            return $this
                ->orderBy('exchange_time','desc')
                ->get();
        }                
	}
}