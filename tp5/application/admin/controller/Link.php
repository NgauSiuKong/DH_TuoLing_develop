<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
//use \app\admin\model\Common;
//分类管理控制器
class Link extends Controller
{
    public function index()
    {
        $link_sql = "select class_title,link_id,link_title,link_url,from_unixtime(link_createtime,'%Y-%m-%d %H:%i:%s') as link_createtime,link_status
            from ns_link nl 
            left join ns_class ns 
            on nl.class_id = ns.class_id
            order by link_id desc";
        $link_list = Db::query($link_sql);
        $this->assign('link_list',$link_list);
        return $this->fetch();
        //return view();
    }
    public function add()
    {
        if(request()->isPost()){ 
            $data = input('post.');
            $data['link_createtime'] = time();
            $res = db('link')->insert($data);
            if($res){ 
                $this->success('添加标签成功',url('index'));
            }else{ 
                $this->error('添加标签失败');
            }
            return;
        }
        //展示之前查出链接的分类
        $class_link_id = 5;
        $where_condition = array( 
            'class_fid' => $class_link_id,
            'class_status' => 1
        );
        $link_list = Db::name('class')
        ->where($where_condition)
        ->field('class_id,class_title')
        ->order('class_oid,class_id')
        ->select();
        $this->assign('link_list',$link_list);
        return $this->fetch();
    }

}
