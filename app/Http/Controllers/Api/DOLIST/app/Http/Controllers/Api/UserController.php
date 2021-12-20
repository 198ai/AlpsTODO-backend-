<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client as Guzzle;
class UserController extends Controller
{
    private $http;
    public function __construct(Guzzle $http)
    {
        $this->http=$http;
    }
    //返回用户列表
    public function index(){
        //3个用户为一页
        $users = User::paginate(3);
        return $users;
    }
    //返回单一用户信息
    public function show(User $user){
        return $user;
    }
    //用户注册
    public function store(UserRequest $request){
      
       User::create($request->all());

        $response = $this->http->post('http://xuexi.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'LdjNPGMdpcfmpzAMXhjUvx2Orerxlznfk5r5jNF9',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '*',
            ],
        ]);
        $token = json_decode((string) $response->getBody(), true);
        return response()->json([
            'token'=>$token 
           ],201);
    }
    //用户登录
    public function login(Request $request){
        $res=Auth::guard('web')->attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ]);
        if($res){
            User::createToken('Token Name')->accessToken;
            return '用户登录成功...';
        }
        return '用户登录失败';
    }

}
