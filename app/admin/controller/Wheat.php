<?php

namespace app\admin\controller;


class Wheat extends Common
{
//小麦列表
    public function index(){
//        $this->templateList('wheat',$join,$filed,$where,$order);
        if(request()->isPost()){
            $key=input('post.key');
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list= \app\admin\model\Wheat::getList($key,$pageSize,$page);
            foreach ($list['data'] as $k=>$v){
                $list['data'][$k]['reg_time'] = date('Y-m-d H:s',$v['reg_time']);
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return $this->fetch();
    }
    public function wheatDel(){
        db('wheat')->where(['id'=>input('id')])->update(['delete'=>1]);
        return $result = ['delete'=>1,'msg'=>'删除成功!'];
    }
    //设置状态
    public function wheatState(){
        $id=input('post.id');
        $is_lock=input('post.is_lock');
        if(db('wheat')->where('id='.$id)->update(['is_lock'=>$is_lock])!==false){
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
    }
    public function edit($id=''){
        if(request()->isPost()){
            $wheat = db('wheat');
            $data = input('post.');
            if ($wheat->update($data)!==false) {
                $result['msg'] = '小麦修改成功!';
                $result['url'] = url('index');
                $result['code'] = 1;
            } else {
                $result['msg'] = '小麦修改失败!';
                $result['code'] = 0;
            }
            return $result;
        }else{
            $wheatType = \app\admin\model\WheatType::all();
            $info = \app\admin\model\Wheat::get(['id'=>input('id')]);
            $selected = db('wheat_type')->where('id',$info['type_id'])->find();
            $this->assign('selected',json_encode($selected,true));
            $this->assign('info', $info->toJson());
            $this->assign('wheatType',json_encode($wheatType,true));
            $this->assign('title',lang('edit').lang('admin'));
            return view();
        }
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            //添加
            if ( \app\admin\model\Wheat::create($data)) {
                return ['code'=>1,'msg'=>'小麦添加成功!','url'=>url('index')];
            } else {
                return ['code'=>0,'msg'=>'小麦添加失败!'];
            }
        }else{
            $wheatType = \app\admin\model\WheatType::all();
            $this->assign('wheatType',json_encode($wheatType,true));
            $this->assign('info','null');
            $this->assign('selected', 'null');
            $this->assign('title',lang('add').lang('wheat'));
            return view('edit');
        }
    }
}