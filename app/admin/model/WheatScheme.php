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
        'create_time' => 'timestamp:Y-m-d',
        'update_time' => 'timestamp:Y-m-d',
    ];
    protected $update = [];

    protected $autoWriteTimestamp = true;//自动生成创建时间和更新时间

    public static function getSchemeList($key, $pageSize, $page)
    {
        $mScheme = new WheatScheme();
        $mScheme->view('WheatScheme','*')
            ->view('Wheat','name,img_url,type_id','WheatScheme.wheat_id = Wheat.id')
            ->view('WheatType','type_name','Wheat.type_id = WheatType.id')
            ->view('WheatStrategy bch','strategy_name bch_name','WheatScheme.bch_id = bch.id')
            ->view('WheatStrategy water','strategy_name water_name','WheatScheme.water_id = water.id')
            ->view('WheatStrategy manure','strategy_name manure_name','WheatScheme.manure_id = manure.id');
        $arr =  $mScheme ->where('WheatScheme.delete', '=', 0)
            ->where('Wheat.name', 'like', "%" . $key . "%")
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
//        dump($mScheme->getLastSql());
        return $arr;
    }
    public static function getSchemeListForHtml($key, $pageSize, $page)
    {
        $mScheme = new WheatScheme();
        $mScheme->view('WheatScheme','*')
            ->view('Wheat','name,img_url,type_id','WheatScheme.wheat_id = Wheat.id')
            ->view('WheatType','type_name','Wheat.type_id = WheatType.id')
            ->view('WheatStrategy bch','strategy_name bch_name','WheatScheme.bch_id = bch.id')
            ->view('WheatStrategy water','strategy_name water_name','WheatScheme.water_id = water.id')
            ->view('WheatStrategy manure','strategy_name manure_name','WheatScheme.manure_id = manure.id');
        $arr =  $mScheme ->where('WheatScheme.delete', '=', 0)
            ->where('WheatScheme.abstract', 'like', "%" . $key . "%")
            ->paginate(array('list_rows' => $pageSize, 'page' => $page))
            ->toArray();
//        dump($mScheme->getLastSql());
        return $arr;
    }
    public static function getSchemeContentForHtml($key)
    {
        $mScheme = new WheatScheme();
        $mScheme->view('WheatScheme','abstract')
            ->view('Wheat','name,img_url','WheatScheme.wheat_id = Wheat.id')
            ->view('WheatType','type_name','Wheat.type_id = WheatType.id')
            ->view('WheatStrategy bch','strategy_name bch_name,strategy_content bch_content','WheatScheme.bch_id = bch.id')
            ->view('WheatStrategy water','strategy_name water_name,strategy_content water_content','WheatScheme.water_id = water.id')
            ->view('WheatStrategy manure','strategy_name manure_name,strategy_content manure_content','WheatScheme.manure_id = manure.id');
        $arr =  $mScheme ->where('WheatScheme.delete', '=', 0)
            ->where('WheatScheme.is_lock', '=', 0)
            ->where('WheatScheme.id', '=', $key )
            ->paginate()
            ->toArray();
//        dump($mScheme->getLastSql());
        return $arr;
    }
}