<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
//use \app\admin\model\Common;
//分类管理控制器
class Label extends Controller
{
    public function index()
    {
        $label_sql = "select label_id,label_title,label_status from ns_label order by label_oid,label_id desc";
        $label_list = Db::query($label_sql);
        $this->assign("label_list",$label_list);
        return view();
    }
    public function add()
    {
        if(request()->isPost()){ 
            $data = input('post.');
            $data['label_createtime'] = time();
            $res = db('label')->insert($data);
            if($res){ 
                $this->success('添加标签成功',url('index'));
            }else{ 
                $this->error('添加标签失败');
            }
            return;
        }
        return view();
    }

}
