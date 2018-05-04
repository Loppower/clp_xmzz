<?php
/**
 * Created by PhpStorm.
 * User: YSH
 * Date: 2018/4/19
 * Time: 19:33
 */

namespace app\admin\controller;


class WheatType extends Common
{
//小麦类型列表
    public function index(){
        if(request()->isPost()){
            $key=input('post.key');
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list=\app\admin\model\WheatType::getList($key,$pageSize,$page);
            foreach ($list['data'] as $k=>$v){
                $list['data'][$k]['reg_time'] = date('Y-m-d H:s',$v['reg_time']);
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return $this->fetch();
    }
//设置状态
    public function typeState(){
        $id=input('post.id');
        $is_lock=input('post.is_lock');
        if(db('wheat_type')->where('id='.$id)->update(['is_lock'=>$is_lock])!==false){
            return ['status'=>1,'msg'=>'设置成功!'];
        }else{
            return ['status'=>0,'msg'=>'设置失败!'];
        }
    }
    public function del(){
        $res = \app\admin\model\WheatType::update(['delete'=>1],['id'=>input('id')]);
        if ($res){
            return  ['code'=>1,'msg'=>'删除成功!'];
        }else{
            return  ['code'=>1,'msg'=>'删除失败!'];
        }
    }
    public function edit(){
        if(request()->isPost()){
            $data = input('post.');
            if (\app\admin\model\WheatType::update($data)) {
                $result['msg'] = '小麦类型修改成功!';
                $result['url'] = url('index');
                $result['code'] = 1;
            } else {
                $result['msg'] = '小麦类型修改失败!';
                $result['code'] = 0;
            }
            return $result;
        }else{
            $info = \app\admin\model\WheatType::get(['id'=>input('id')]);
            $this->assign('info', $info->toJson());
            $this->assign('title',lang('edit').lang('wheatType'));
            return view();
        }
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            $data['delete'] = 0;
            //添加
            if ( \app\admin\model\WheatType::create($data)) {
                return ['code'=>1,'msg'=>'小麦类型添加成功!','url'=>url('index')];
            } else {
                return ['code'=>0,'msg'=>'小麦类型添加失败!'];
            }
        }else{
            $this->assign('info','null');
            $this->assign('title',lang('add').lang('wheatType'));
            return view('edit');
        }
    }
}