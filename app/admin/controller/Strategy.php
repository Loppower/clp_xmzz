<?php

namespace app\admin\controller;


use app\admin\model\WheatStrategy;

class Strategy extends Common
{
    /**
     * 默认方法，可以不配
     * @param $type
     *  BCH,WATER...
     * @return array
     */
    private function index($type){
        $key=input('post.key');
        $page =input('page')?input('page'):1;
        $pageSize =input('limit')?input('limit'):config('pageSize');
        return WheatStrategy::getListByType($type,$key,$pageSize,$page);
    }
    public function del(){
        db('wheat_strategy')->where(['id'=>input('id')])->update(['delete'=>1]);
        return $result = ['delete'=>1,'msg'=>'删除成功!'];
    }
    //设置状态
    public function state(){
        $id=input('post.id');
        $is_lock=input('post.is_lock');
        if(db('wheat_strategy')->where('id='.$id)->update(['is_lock'=>$is_lock])!==false){
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
    }
    public function edit($type){
        if(request()->isPost()){
            $wheat = db('wheat_strategy');
            $data = input('post.');
            if ($wheat->update($data)!==false) {
                $result['msg'] = '修改成功!';
                $result['url'] = url($type.'_index');
                $result['code'] = 1;
            } else {
                $result['msg'] = '修改失败!';
                $result['code'] = 0;
            }
            return $result;
        }else{
            $info = WheatStrategy::get(['id'=>input('id')]);
            $this->assign('info', $info->toJson());
            $this->assign('strategy_content', $info['strategy_content']);
            $this->assign('title',lang('edit').lang($type));
            return view($type.'_edit');
        }
    }

    public function add($type)
    {
        if(request()->isPost()){
            $data = input('post.');
            $data['delete'] = 0;
            //添加
            if ( WheatStrategy::create($data)) {
                return ['code'=>1,'msg'=>'添加成功!','url'=>url($type.'_index')];
            } else {
                return ['code'=>0,'msg'=>'添加失败!'];
            }
        }else{
            $this->assign('info','null');
            $this->assign('title',lang('add').lang($type));
            return view($type.'_edit');
        }
    }
    /**
     * bch
     * 通过传入不同type标记即可实现不同页面的显示
     * @return array|mixed
     */
    public function bch_index()
    {
        if(request()->isPost()){
            $list =  $this->index('bch');
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return $this->fetch();
    }

    public function bch_edit()
    {
        return $this->edit('bch');
    }
    public function bch_add()
    {
        return $this->add('bch');
    }
}