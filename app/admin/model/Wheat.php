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
        'create_time' => 'timestamp:Y-m-d',
        'update_time' => 'timestamp:Y-m-d',
    ];
    protected $update = [];

    protected $autoWriteTimestamp = true;//自动生成创建时间和更新时间

    public static function getList($key, $pageSize, $page)
    {
        $wheat = new Wheat();
        $arr = $wheat->view('Wheat','*')
            ->view('WheatType','type_name','WheatType.id = Wheat.id','left')
            ->where('Wheat.name|WheatType.type_name', 'like', "%" . $key . "%")
            ->where('Wheat.delete', '=', 0)
            ->order('Wheat.sort desc')
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
        return $arr;
    }
}