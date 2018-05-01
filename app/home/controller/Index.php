<?php
namespace app\home\controller;
use app\admin\model\WheatScheme;

class Index extends Common{
    public function _initialize(){
        parent::_initialize();
    }
    public function index(){
        return $this->fetch('new_index');
    }
    public function xmzz(){
        $data =  input('get.');
        $list =  WheatScheme::getSchemeListForHtml($data['wd'],10,1);
//        dump($list['data']);
        $this->assign('data',$list['data']);
        return $this->fetch('index_list');
    }

    public function detail(){
        $data =  WheatScheme::getSchemeContentForHtml(input('id'));
        $data = $data['data'][0];
//        dump($data);
        $this->assign('data',$data);
        return $this->fetch('index_detail');
    }

}