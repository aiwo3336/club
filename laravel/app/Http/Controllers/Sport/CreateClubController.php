<?php
namespace App\Http\Controllers\Sport;
header('Access-Control-Allow-Origin:*');
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Model\Sport\Club;
class CreateClubController extends Controller
{
    public function index()
    {
        $result = $this->uploadFiles(Input::file('club_img'));
        return $result;
    }

    public function uploadFiles($file){
        if($file -> isValid()){
            //检验一下上传的文件是否有效.
            $clientName = $file -> getClientOriginalName();
            $extension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = md5(date('ymdhis').$clientName).".".$extension;
            $file -> move('uploads/images/',$newName);
            return 'uploads/images/'.$newName;

        }
    }
}