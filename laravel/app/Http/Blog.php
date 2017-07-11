<?php 

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理城市接口数据
*/
class Blog extends Model
{

    protected $table='blog';
    protected $primaryKey='blog_id';
    public $timestamps=false;
    protected $fillable = [
        'blog_title',
        'blog_img',
        'blog_grade',
        'blog_body',
        'blog_tool',
        'blog_content',
        'blog_create',
        'blog_update',
    ];
    protected $hidden=[

    ];    
	//查询分页：
	public function getBlog($limit,$pageSize,$grade)
	{
        if(!empty($grade)){
            return $this
                ->where(['blog_grade'=>$grade])
                ->orderBy('blog_grade','desc')
                ->offset($limit)
                ->limit($pageSize)
                ->get();
        }else{
            return $this
                ->orderBy('blog_grade','desc')
                ->offset($limit)
                ->limit($pageSize)
                ->get();
        }
	}
	public function getGrade($blog_grade)
	{
        return $this->find($blog_grade);
	}

}