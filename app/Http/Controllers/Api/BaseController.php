<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class BaseController extends Controller
{
    //API　JSONのフォーマット
    protected function create($data,$msg='',$code =200){
        $result =[
         'code'=>$code,
         'msg'=>$msg,
         'data'=>$data
        ];
        return response($result,$code);
    }
}
