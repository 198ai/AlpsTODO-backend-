<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\Api\UserResource;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //全体的ユーザを洗い出す
    public function index(){
         //3个用户为一页
         $users = User::paginate(8);
         return UserResource::collection($users);
    }
     //返回单一用户信息
     public function show(User $user){
        return $this->success(new UserResource($user));
        
    }
    //用户注册
    public function store(UserRequest $request){
        $users =User::create($request->all());
        return $this->setStatusCode(201)->success('用户注册成功',$users);
    }
    // //用户登录
    // public function login(Request $request){
    //     $res=Auth::guard('web')->attempt(['name'=>$request->name,'password'=>$request->password]);
    //     if($res){
    //         return $this->setStatusCode(201)->success('用户登录成功...');
    //     }
    //     return $this->failed('用户登录失败',401);
    // }
    //用户登录
public function login(Request $request){
    $token=Auth::guard('api')->attempt(['name'=>$request->name,'password'=>$request->password]);
    if($token) {
        $userData =Auth::guard('api')->user();
        return $this->setStatusCode(201)->success(['token' => 'bearer ' . $token,'userData' => $userData]);
       
    }
    return $this->failed('账号或密码错误',400);
    }
    //用户退出
    public function logout(){
        Auth::guard('api')->logout();
        return $this->success('退出成功...');
    }
    //返回当前登录用户信息
    public function info(){
        $user = Auth::guard('api')->user();
        return $this->success(new UserResource($user));
        //dd($user);
    }
    

}
