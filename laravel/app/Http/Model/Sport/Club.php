<?php
namespace App\Http\Model\Sport;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
* 此model层用来处理景点接口数据
*/
class Club extends Model
{
    protected $table='club';
    protected $primaryKey='club_id';
    public $timestamps=false;
    protected $fillable = [
        'club_id',
        'club_level',
        'club_name',
        'club_price',
        'club_intro',
        'club_img',
        'club_update',
        'club_create',
        'is_active',
        'active_price',
        'active_start',
        'active_end',
        'is_hot',
        'sort',
        'status',
        'club_contents',
        'club_address',
    ];
    protected $hidden=[

    ];
    //查询热门俱乐部基本信息
    public function getHotClub(){
        return $this->select(['club_id','club_level','club_name','club_price','club_intro','club_img'])->where(['is_hot'=>1,'status'=>1])->orderBy('sort','desc')->limit(4)->get();
    }
    //查询俱乐部基本信息，倒叙排列
    public function getSortClub($limit,$pageSize){
            return $this->select(['club_id','club_level','club_name','club_price','club_intro','club_img'])
                            ->where(['status'=>1])
                            ->orderBy('sort','desc')
                            ->offset($limit)
                            ->limit($pageSize)
                            ->get();
    }

    //添加加入俱乐部
    public function clubPost($post){
        return $this->fill($post)->save();
    }
    //查询俱乐部 @param  club_id
    function getClubId($club_id){
        return $this->find($club_id);
    }
    function updateClub($data){
        $club_id=$data['club_id'];
        $data['club_update']=time();
        $res=$this->find($club_id)->update($data);
        return $res;
    }
//	public function getPort($limit,$pageSize)
//	{
//        if(!empty($pageSize)){
//            return $this
//                ->orderBy('parkland_sort','desc')
//                ->offset($limit)
//                ->limit($pageSize)
//                ->get();
//        }else{
//            return $this
//                ->orderBy('parkland_sort','desc')
//                ->get();
//        }
//	}
//	public function getCityPort($city)
//	{
//        return $this->where('parkland_city_name','like',"%$city%")->get();
//	}
//	public function getParkland($parkland)
//	{
//        return $this->where('parkland_name','like',"%$parkland%")->orderBy('parkland_sort','desc')->get();
//	}
//	public function getParklandId($parkland_id)
//	{
//        return $this->find($parkland_id);
//	}
//    /**
//     * 景点表city_id查询
//     * @var 	string  $city_id
//     * @return 	array
//     */
//
//    function searchCityPark($city_id)
//    {
//        return $this->where(['city_id' => $city_id])->get();
//    }
//
//
//    function searchWork($search)
//    {
//        return DB::table('city')->where('city_name' ,'like', "$search%")->first();
//    }
//
//    /**
//     * 城市表ID查询
//     * @var 	string  $id
//     * @return 	array
//     */
//
//    function searchCityOne($id)
//    {
//        return DB::table('travel_city')->where(['city_id' => $id])->first();
//    }

}