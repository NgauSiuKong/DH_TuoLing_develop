<?php
namespace app\index\controller;
use think\Db;
class Blog extends Common
{
    public function index()
    {
        $class_top_id = input("get.class_id");
        $res = preg_match("/\d/",$class_top_id);
        if(!$res) die('URL错误');
        //查询分类是1的二级分类
        $class_1_sql = "select group_concat(class_id) as class_1_id from ns_class where class_status = 1 and class_fid=".$class_top_id;
        $class_1_list = Db::query($class_1_sql);
        $class_1_str = $class_1_list[0]['class_1_id'].",".$class_top_id;
        //博客展示页面
        $blog_sql = "select bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,from_unixtime(bloginfo_createtime,'%Y') as year,from_unixtime(bloginfo_createtime,'%m-%d') as date,from_unixtime(bloginfo_createtime,'%Y-%m-%d') as bloginfo_createtime from ns_bloginfo where bloginfo_status = 1 and class_id in (".$class_1_str.") order by bloginfo_id desc";
        $blog_list = Db::query($blog_sql);
        //时间轴数据
        $time_axis = array();$j=1;
        for($i=4;$i>=0;$i--){
            $time_axis[$i]['createtime'] = $blog_list[$i]['bloginfo_createtime'];
            $time_axis[$i]['title'] = $blog_list[$i]['bloginfo_title'];
            $time_axis[$i]['class_tag'] = $j;
            $j++;
        }
        $this->assign('blog_list',$blog_list);
        $this->assign('time_axis',$time_axis);
        return view();
    }
}
