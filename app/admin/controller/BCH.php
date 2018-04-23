<?php

namespace app\admin\controller;


class BCH extends Common
{
//病虫害列表
    public function index(){
        if(request()->isPost()){
            $key=input('post.key');
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $list=db('wheat')->alias('w')
                ->join(config('database.prefix').'wheat_type wt','w.id = wt.wheat_id','left')
                ->field('w.*,wt.type_name')
                ->where('w.name|wt.type_name','like',"%".$key."%")
                ->order('w.sort desc')
                ->paginate(array('list_rows'=>$pageSize,'page'=>$page))
                ->toArray();
            foreach ($list['data'] as $k=>$v){
                $list['data'][$k]['reg_time'] = date('Y-m-d H:s',$v['reg_time']);
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return $this->fetch();
    }
    public function wheatDel(){
        db('wheat')->delete(['id'=>input('id')]);
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
}