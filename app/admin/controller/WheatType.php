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
            $list=db('wheat_type')->alias('w')
                ->field('w.*')
                ->where('w.type_name','like',"%".$key."%")
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
}