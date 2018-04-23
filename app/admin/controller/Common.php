<?php
namespace app\admin\controller;
use think\Request;
use think\Db;
use think\Controller;
class Common extends Controller
{
    protected $mod,$role,$system,$nav,$menudata,$cache_model,$categorys,$module,$moduleid,$adminRules,$HrefId;
    public function _initialize()
    {

        //判断管理员是否登录
        if (!session('aid')) {
            $this->redirect('login/index');
        }
        define('MODULE_NAME',strtolower(request()->controller()));
        define('ACTION_NAME',strtolower(request()->action()));
        //权限管理
        //当前操作权限ID
        if(session('aid')!=1){
            $this->HrefId = db('auth_rule')->where('href',MODULE_NAME.'/'.ACTION_NAME)->value('id');
            //当前管理员权限
            $map['a.admin_id'] = session('aid');
            $rules=Db::table(config('database.prefix').'admin')->alias('a')
                ->join(config('database.prefix').'auth_group ag','a.group_id = ag.group_id','left')
                ->where($map)
                ->value('ag.rules');
            $this->adminRules = explode(',',$rules);
            if($this->HrefId){
                if(!in_array($this->HrefId,$this->adminRules)){
                    $this->error('您无此操作权限','index');
                }
            }
        }
        $this->system = F('System');
        $this->categorys = F('Category');
        $this->module = F('Module');
        $this->mod = F('Mod');
        $this->role = F('Role');
        $this->cache_model=array('Module','Role','Category','Posid','Field','System');
        if(empty($this->system)){
            foreach($this->cache_model as $r){
                savecache($r);
            }
        }
    }
    //空操作
    public function _empty(){
        return $this->error('空操作，返回上次访问页面中...');
    }

    /**
     * @param $db_name
     * @param array $join
     * 1:关联查询表名
     * 2:condition 'w.id = wt.wheat_id'
     * 3:type left/right
     * @param $filed
     * @param $where
     * @param $order
     * @return array|mixed
     */
    public function templateList($db_name,$join =array(),$filed,$where,$order){
        if(request()->isPost()){
            $key=input('post.key');
            $page =input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):config('pageSize');
            $db = db($db_name)->alias('db');
            if (!count($join)){//如果二维数组join数不为0
                foreach ($join as $jo) {
                    $db =  $db->join(config('database.prefix').$jo['name'],$jo['condition'],$jo['type']);
                }
            }
            $db = $db->field($filed)->where($where,'like',"%".$key."%")->order($order);
            $list=$db->paginate(array('list_rows'=>$pageSize,'page'=>$page))
                ->toArray();
            foreach ($list['data'] as $k=>$v){
                $list['data'][$k]['reg_time'] = date('Y-m-d H:s',$v['reg_time']);
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1];
        }
        return $this->fetch();
    }
}
