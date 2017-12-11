<?php
namespace app\admin\controller;
use app\admin\model;
use think\Controller;
use think\Db;
//use \app\admin\model\Common;
//分类管理控制器
class Blog extends Common
{
    public function index()
    {
        //查询博客详情表,展示博客信息
        $blog_sql = "SELECT bloginfo_id,bloginfo_title,bloginfo_describe,bloginfo_status,
                            FROM_UNIXTIME(bloginfo_createtime,'%Y-%m-%d %H:%i:%s') as bloginfo_createtime,class_title 
                     FROM ns_bloginfo as nb 
                     LEFT JOIN ns_class nc 
                     ON nb.class_id = nc.class_id";
        $blog_list = Db::query($blog_sql);
        /*
        echo "<pre>";
            print_r($blog_list);
        echo "</pre>";
        */
        $this->assign('blog_list',$blog_list);
        return view();
    }
    public function add()
    {
        if(request()->isPost()){
            //过滤收到的数据
            $data_info = input('post.');
            $data_info['bloginfo_createtime'] = time();
            $data_info['bloginfo_updatetime'] = time();
            //上传数据之前,先上传图片
            if($_FILES['bloginfo_img']['error'] == 0){
                //文件上传无误,调用上传类,获取文件路径
                $data_info['bloginfo_img'] = $this->Uploads('bloginfo_img','BlogsImg');
            }else{
                echo "文件上传失败";
                dump($_FILES);die();
            }
            //获取博客内容
            $data_ctt['blogcontent_ctt'] = $data_info['blogcontent_ctt'];
            //获取链接标签id
            $data_blog_label['label_id'] = $data_info['label_id'];
            unset($data_info['blogcontent_ctt']);unset($data_info['label_id']);
            $res_id = Db::name('bloginfo')->insertGetId($data_info);
            if($res_id){
                //添加文章内容
                $data_ctt['bloginfo_id'] = $res_id;
                $res_ctt =db('blogcontent')->insert($data_ctt);
                //添加文章标签链接
                $data_blog_label['bloginfo_id'] = $res_id;
                $res_blog_label = db('label_blog')->insert($data_blog_label);
                if($res_ctt && $res_blog_label){
                    $this->success('文章添加成功',url('index'));
                }else{
                    $this->errors('文章详情添加失败或者文章标签链接添加失败');
                }
            }else{
                $this->errors('文章添加失败');
            }
            return;
        }
        //查询分类,供博客选择
        $class_sql = "select class_id,class_fid,class_title from ns_class where class_status = 1 order by class_oid desc";
        $class_list = Db::query($class_sql);
        $class_list = $this->MCommon->recursionNoTree($class_list,'class_id','class_fid',0,0);
        $class_list = $this->MCommon->addStrForArr($class_list);
        $this->assign("class_list",$class_list);
        //查询标签,供博客选择,多对多
        $label_sql = "select label_id,label_title from ns_label where label_status = 1 order by label_oid,label_id desc";
        $label_list = Db::query($label_sql);
        $this->assign("label_list",$label_list);
        return view();
    }

}
