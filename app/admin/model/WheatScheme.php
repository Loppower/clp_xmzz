<?php
/**
 * Created by PhpStorm.
 * User: YSH
 * Date: 2018/4/25
 * Time: 23:33
 */

namespace app\admin\model;


use think\Model;

class WheatScheme extends Model
{
    protected $type = [
        // 设置addtime为时间戳类型（整型）
        'create_time' => 'timestamp:Y-m-d H:i:s',
        'update_time' => 'timestamp:Y-m-d H:i:s',
    ];
    protected $update = [];

    protected $autoWriteTimestamp = true;//自动生成创建时间和更新时间

    public static function getSchemeList($key, $pageSize, $page)
    {
        $mScheme = new WheatScheme();
        $mScheme->view('WheatScheme','*')
            ->view('Wheat','name,img_url,type_id','WheatScheme.wheat_id = Wheat.id')
            ->view('WheatType','type_name','Wheat.type_id = WheatType.id')
            ->view('WheatStrategy','strategy_name bch_name','WheatScheme.bch_id = WheatStrategy.id');
        $arr =  $mScheme ->where('WheatScheme.delete', '=', 0)
            ->where('Wheat.name', 'like', "%" . $key . "%")
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
//        dump($mScheme->getLastSql());
        return $arr;
    }
}