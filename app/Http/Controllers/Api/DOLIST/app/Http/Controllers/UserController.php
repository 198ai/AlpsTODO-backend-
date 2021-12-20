<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\UserMaster;
use App\Http\Controllers\Auth;
use App\Http\Controllers\UserRequest;
class UserController extends Controller
{
    public function add(){
        // $data=[
        //     'name' =>'田七',
        //     'email' =>'test123@yahoo.co.jp',
        //     'password' =>'12345'
        // ];
        // dump(DB::table('usermaster')->insert($data));
        $model =new UserMaster();
        $model ->name ='田七';
        $model ->email ='test123@yahoo.co.jp';
        $model ->password ='12345';
        $res =$model ->save();
        dump($res);
    }
    public function view(){
        $data =time();
        return view('user',['data'=>$data]);
    }


}
