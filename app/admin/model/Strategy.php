<?php
/**
 * Created by PhpStorm.
 * User: YSH
 * Date: 2018/4/24
 * Time: 18:03
 */

namespace app\admin\model;


use think\Model;

class Strategy extends Model
{
    protected $type = [
        // 设置addtime为时间戳类型（整型）
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
    ];
    protected $update = [];

    protected $autoWriteTimestamp = true;//自动生成创建时间和更新时间

    public static function getListByType($type, $key, $pageSize, $page)
    {
        $db = db('wheat_strategy')->alias('s');
        $arr =  $db->field('s.*')
            ->where('s.strategy_name', 'like', "%" . $key . "%")
            ->where('s.delete', '=', 0)
            ->where('s.type', '=', $type)
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
//        dump($db->getLastSql());
        return $arr;
    }
}