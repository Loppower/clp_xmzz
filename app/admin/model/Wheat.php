<?php
/**
 * Created by PhpStorm.
 * User: YSH
 * Date: 2018/4/23
 * Time: 18:35
 */

namespace app\admin\model;


use think\Model;

class Wheat extends Model
{
    protected $type  = [
        // 设置addtime为时间戳类型（整型）
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
    ];
    protected $update = [];

    protected $autoWriteTimestamp = true;//自动生成创建时间和更新时间
}