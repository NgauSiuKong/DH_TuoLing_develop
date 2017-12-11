<?php
namespace app\index\controller;
use think\Db;
class Index extends Common
{
    public function index()
    {
        //首页图片展示
        $homepage_sql = "select homepage_id,homepage_title,homepage_url,homepage_image,homepage_text from ns_homepage where homepage_status = 1 order by homepage_oid desc limit 3";
        $homepage_list = Db::query($homepage_sql);
        //首页博客展示
        $blog_sql = "select bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_img,from_unixtime(bloginfo_createtime,'%Y') as year,from_unixtime(bloginfo_createtime,'%m-%d') as date,from_unixtime(bloginfo_createtime,'%Y-%m-%d') as bloginfo_createtime from ns_bloginfo where bloginfo_status = 1 order by bloginfo_id desc";
        $blog_list = Db::query($blog_sql);
        $this->assign('blog_list',$blog_list);
        $this->assign("homepage_list",$homepage_list);
        return view();
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
}
