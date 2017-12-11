<?php
namespace app\index\controller;
use think\Db;
class Content extends Common
{
    public function index()
    {
        $bloginfo_id = input("get.bloginfo_id");
        $res = preg_match("/\d/",$bloginfo_id);
        if(!$res) die('URL错误');

        $blogcontent_sql = "SELECT nb.bloginfo_id as blog_id,bloginfo_title,bloginfo_describe,FROM_UNIXTIME(bloginfo_createtime,'%Y-%m-%d') as bloginfo_createtime,blogcontent_ctt
                            FROM ns_bloginfo nb 
                            INNER JOIN ns_blogcontent nbc 
                            ON nb.bloginfo_id = nbc.bloginfo_id 
                            WHERE nb.bloginfo_id = ".$bloginfo_id."";
        $blogcontent_info = Db::query($blogcontent_sql);
        $this->assign("blogcontent_info",$blogcontent_info[0]);
        return view();
    }
}
