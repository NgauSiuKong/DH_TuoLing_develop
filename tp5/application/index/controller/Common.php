<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Common extends controller
{
    //构造方法,初始化前端页面,展示分类
    public function _initialize()
    {
        /*
        $top_class_sql = "select class_id,class_title,class_Etitle from ns_class where class_fid = 0 and class_status = 1 order by class_oid desc";
        $top_class_list = Db::query($top_class_sql);

        $path_pre = "http://".$_SERVER['HTTP_HOST']."/index.php/index/";
        foreach($top_class_list as $key => $val){
            $top_class_list[$key]['path_url'] = $path_pre.$val['class_Etitle'];
        }
        $this->assign('top_class_list',$top_class_list);
        */
        return $this->fetch('public/header');
    }
}
