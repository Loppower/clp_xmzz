<?php

namespace app\admin\controller;


use app\admin\model\WheatScheme;
use app\admin\model\WheatStrategy;

class Scheme extends Common
{
    /**
     * @return array
     */
    public function index()
    {
        if (request()->isPost()) {
            $key = input('post.key');
            $page = input('page') ? input('page') : 1;
            $pageSize = input('limit') ? input('limit') : config('pageSize');
            $list = WheatScheme::getSchemeList($key, $pageSize, $page);
            return $result = ['code' => 0, 'msg' => '获取成功!', 'data' => $list['data'], 'count' => $list['total'], 'rel' => 1];
        }
        return $this->fetch();
    }

    /**
     * 实际开发中，不可能直接删除数据，而是将数据delete标记置为1，表示删除
     * @return array
     */
    public function del()
    {
       if ( WheatScheme::update(['delete' => 1],['id' => input('id')])){
           return $result = ['delete' => 1, 'msg' => '删除成功!'];
       }
        return $result = ['delete' => 0, 'msg' => '删除失败!'];
    }

    //设置状态
    public function state()
    {
        $id = input('post.id');
        $is_lock = input('post.is_lock');
        if (WheatScheme::update(['is_lock' => $is_lock],['id' => $id]) !== false) {
            return ['status' => 1, 'msg' => '设置成功!'];
        } else {
            return ['status' => 0, 'msg' => '设置失败!'];
        }
    }

    public function edit()
    {
        if (request()->isPost()) {
            $data = input('post.');

            $wheat_id =explode(':',$data['wheat_id']);
            $data['wheat_id'] = $wheat_id[1];

            $bch_id =explode(':',$data['bch_id']);
            $data['bch_id'] = $bch_id[1];
            $water_id =explode(':',$data['water_id']);
            $data['water_id'] = $water_id[1];
            $manure_id =explode(':',$data['manure_id']);
            $data['manure_id'] = $manure_id[1];
            //在后面添加新的模块数据
            //每次添加新数据时生成一份摘要存储，方便查询
            $wheat =  \app\admin\model\Wheat::get($wheat_id)->getData();
            $wheat_type = \app\admin\model\WheatType::get($wheat['type_id'])->getData();
            $bch = WheatStrategy::get($bch_id)->getData();
            $water = WheatStrategy::get($water_id)->getData();
            $manure = WheatStrategy::get($manure_id)->getData();
            $data['abstract'] = $wheat_type['type_name'].$wheat['name'].$bch['strategy_name'].$water['strategy_name'].$manure['strategy_name'];

//在后面添加新的模块
            if (WheatScheme::update($data) !== false) {
                $result['msg'] = '修改成功!';
                $result['url'] = url( 'index');
                $result['code'] = 1;
            } else {
                $result['msg'] = '修改失败!';
                $result['code'] = 0;
            }
            return $result;
        } else {
            $this->assignSchemeParam();
            $info = WheatScheme::get(['id' => input('id')]);
            $this->assign('info', $info->toJson());
            $this->assign('title', lang('edit') . lang('方案'));
            return view( 'edit');
        }
    }

    /**
     * array(3) {
    ["wheat_id"] =&gt; string(9) "number:10"
    ["bch_id"] =&gt; string(8) "number:3"
    ["delete"] =&gt; int(0)
    }josn转换时候把数据类型也转换了，所以在存储时需要把数据再处理下
     *
     * @return array|\think\response\View
     */
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $wheat_id =explode(':',$data['wheat_id']);
            $data['wheat_id'] = $wheat_id[1];
            $bch_id =explode(':',$data['bch_id']);
            $data['bch_id'] = $bch_id[1];
            $water_id =explode(':',$data['water_id']);
            $data['water_id'] = $water_id[1];
            $manure_id =explode(':',$data['manure_id']);
            $data['manure_id'] = $manure_id[1];
            //在后面添加新的模块数据
            //每次添加新数据时生成一份摘要存储，方便查询
            $wheat =  \app\admin\model\Wheat::get($wheat_id)->getData();
            $wheat_type = \app\admin\model\WheatType::get($wheat['type_id'])->getData();
            $bch = WheatStrategy::get($bch_id)->getData();
            $water = WheatStrategy::get($water_id)->getData();
            $manure = WheatStrategy::get($manure_id)->getData();
            $data['abstract'] = $wheat_type['type_name'].$wheat['name'].$bch['strategy_name'].$water['strategy_name'].$manure['strategy_name'];
            $data['delete'] = 0;
            //添加
            if (WheatScheme::create($data)) {
                return ['code' => 1, 'msg' => '添加成功!', 'url' => url('index')];
            } else {
                return ['code' => 0, 'msg' => '添加失败!'];
            }
        } else {
            $this->assignSchemeParam();
            $this->assign('info', 'null');
            $this->assign('title', lang('add') . lang('方案'));
            return view( 'edit');
        }
    }

    /**
     * 在这里添加你的方案需要用到的数据
     */
    private function assignSchemeParam(){
        $wheat = db('Wheat')->where(array('delete'=>0))->select();
        $this->assign('allWheat',json_encode($wheat,true));
        $wheat_strategy = db('wheat_strategy')->where(array('delete'=>0))->where(array('type'=>'bch'))->select();
        $this->assign('allBch',json_encode($wheat_strategy,true));

        $wheat_strategy = db('wheat_strategy')->where(array('delete'=>0))->where(array('type'=>'water'))->select();
        $this->assign('allWater',json_encode($wheat_strategy,true));

        $wheat_strategy = db('wheat_strategy')->where(array('delete'=>0))->where(array('type'=>'manure'))->select();
        $this->assign('allManure',json_encode($wheat_strategy,true));
    }
}