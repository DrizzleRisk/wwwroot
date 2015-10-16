<?php
namespace Home\Controller;
use Think\Controller;
class AssessController extends Controller {
	
    public function index(){

    	$model = M('Assess');
    	if($_POST['assesstype'] != NULL) {
    		//查询
    		$conn['assesstype'] = array('like','%'.$_POST['assesstype'].'%');
    		$list = $model->where($conn)->order('id asc')->select();
    	} else {
    		$list = $model->order('id asc')->select();
    	}
    	$this->assign('list',$list);// 赋值数据集
        $this->display();
    }
    
    public function edit(){
    	$id = $_GET['id'];
    	if($id == NULL ||  is_numeric($id) == FALSE) {
    		echo "id Error.";
    		return 0;
    	}
    	$model = M('Assess');
    	$conn['id'] = $id;
    	$data = $model->where($conn)->find();
    	if($data == NULL) {
    		echo "No record.";
    		return 0;
    	}
    	$this->assign('data',$data);// 赋值数据集
    	$this->display();
    }
    
    public function del() {
    	$id = $_GET['id'];
    	if($id == NULL ||  is_numeric($id) == FALSE) {
    		echo "id Error.";
    		return 0;
    	}
    	$model = M("Assess");
    	$conn['id'] = $id;
    	$result = $model->where($conn)->delete();
    	if($result) {
    		$this->success('您删除了'.$result.'条数据！', U('Assess/index'));
    	} else {
    		$this->error('删除新风险项出现错误！',U('Assess/index'));
    	}
    	
    }
    
    public function add(){
    	if($_POST == NULL) {
    		$this->display();
    		return 0;
    	}
    	$Type = M("Assess");
    	if($Type->create()){
    		$result = $Type->add(); // 写入数据到数据库 
	    	if($result){
	    		// 如果主键是自动增长型 成功后返回值就是最新插入的值
	    		$this->success('创建风险类型成功！', U('Assess/index'));
	    	} else {
	    		$this->error('创建风险类型出现错误！',U('Assess/index'));
	    	}
    	}
    }
    public function save(){
    	$Type = M("Assess"); // 实例化User对象
    	// 要修改的数据对象属性赋值
    	$id = $_POST['id'];
    	if($id == NULL) {
    		echo "No record.";
    		return 0;
    	}
    	$conn['id'] = $id;
    	$Type->data = $_POST['assesstype'];
    	$Type->explain = $_POST['explain'];
    	
    	$rst = $Type->where($conn)->save();
    	if($rst == FALSE) {
    		$this->error('更新出现错误！',U('Assess/index'));
    	} else {
    		$this->success('更新成功！', U('Assess/index'));
    	}
    	
    }
}