<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;
 
class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        switch ($this->status){
            case 0:
                $this->status = '正常';
                break;
            case 1:
                $this->status = '已删除';
                break;
        }
        return [
            'id'=>$this->id,
            'name' => $this->name,
            'status' => UserResource::getStatusName($this->status),
            'created_at'=>(string)$this->created_at,
            'updated_at'=>(string)$this->updated_at
        ];
    }


        // 状态类别
    const NORMAL = 0; //正常
    const INVALID = 1; //已删除

    public static function getStatusName($status){
        switch ($status){
            case self::INVALID:
                return '已删除';
            case self::NORMAL:
                return '正常';
            default:
                return '正常';
        }
     }
    
}


