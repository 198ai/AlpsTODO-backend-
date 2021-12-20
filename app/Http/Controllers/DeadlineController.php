<?php

namespace App\Http\Controllers;

//use App\Models\Deadline;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;


class DeadlineController extends Controller
{
    //查詢
    public function getDeadLine(){
        // $deadlineInfo = DB::table('deadline')
        // ->select('deadline.id as deadlineId','title','plantime','endtime','complete')
        // ->get();
        // return response()->json(
        //             $deadlineInfo,
        //             200,[],
        //             JSON_UNESCAPED_UNICODE
        //         )->header('Content-Type','application/json; charset=UTF-8');
        //return "123";
         // 通过 file_get_contents 函数获取百度页面源码
         $html = file_get_contents("https://www.liaoxuefeng.com/wiki/1252599548343744/1255888634635520");
            
         // 通过 preg_replace 函数使页面源码由多行变单行
         $htmlOneLine = preg_replace("/\r|\n|\t/","",$html);
        

         // 通过 preg_match 函数提取获取页面的标题信息
         preg_match("/<title>(.*)<\/title>/iU",$htmlOneLine,$titleArr);

         // 由于 preg_match 函数的结果是数组的形式
         $title = $titleArr[1];

         // 通过 echo 函数输出标题信息
         echo $title;
    }
}