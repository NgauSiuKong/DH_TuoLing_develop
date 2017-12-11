<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
//use \app\admin\model\Common;
//分类管理控制器
class Assortment extends Common
{
    public function index()
    {
        $assortment_list = db('class')->field('class_id,class_fid,class_oid,class_title,class_Etitle,class_describe,class_status,class_path')->order('class_oid desc')->select();
        //无限分类排序
        $assortment_list = $this->MCommon->recursionNoTree($assortment_list,'class_id','class_fid',0,0);
        //无限分类标题拼接延伸符
        $assortment_list = $this->MCommon->addStrForArr($assortment_list);
        $this->assign('assortment_list',$assortment_list);
        return $this->fetch();
    }
    public function add()
    {
        //判断是否传递数据,传递数据处理数据，没传递数据展示页面
        if($_POST){
        //获取数据以及input函数清洗数据
            $data = input('post.');
            $data['class_createtime'] = time();
            $data['class_updatetime'] = time();
            //插入数据
            //方法1，助手函数
            $res = Db::name('class')->insert($data);
            //方法2，导入Db的命名空间,实例化Db类进行插入
            //$res = Db::table('ns_class')->insert($data);
            //方法3,利用Model类上传
            if($res){
                $this->success('添加分类成功！',url('index'));
            }else{
                $this->error('添加分类失败');
            }
            return;
        }else{
            //查询分类
            $assortment_list = db('class')
            ->field('class_id,class_fid,class_title')
            ->order('class_oid desc')
            ->select();
            //无限分类排序
            $assortment_list = $this->MCommon->recursionNoTree($assortment_list,'class_id','class_fid',0,0);
            //无限分类标题拼接延伸符
            $assortment_list = $this->MCommon->addStrForArr($assortment_list);
            $this->assign('assortment_list',$assortment_list);
            return $this->fetch();
        }
    }

}
