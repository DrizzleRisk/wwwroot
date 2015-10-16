<?php
namespace Home\Controller;
use Think\Controller;
class RiskController extends Controller {
	
    public function index(){

    	$model = M('risk');
    	if($_GET['riskname'] != NULL) {
    		//查询
    		$conn['riskname'] = array('like','%'.$_GET['riskname'].'%');
    		$list = $model->field('risk.id risk_id, assessid, class, riskname, risklevel, assess.assesstype, ischeck')->join('Assess ON Assess.id=assessid')->where($conn)->order('assessid asc')->select();
    	} else {
    		$list = $model->field('risk.id risk_id, assessid, class, riskname, risklevel, assess.assesstype, ischeck')->join('Assess ON Assess.id=assessid')->order('assessid asc')->select();
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

    	$model = M('risk');
    	$conn['id'] = $id;
    	$RiskInfo = $model->where($conn)->find();
    	if($RiskInfo == NULL) {
    		echo "No record.";
    		return 0;
    	}
    	$this->assign('RiskInfo',$RiskInfo);
    	
    	
    	#查询所有AssessType，供用户选择修改
    	$Assess = M('Assess');
    	$AssessList = $Assess->select();
    	$this->assign('AssessList', $AssessList);

    	
    	#查询当前AssessType
    	unset($conn);
    	$conn['id'] = $RiskInfo[assessid];
    	$CurrentAssessType = $Assess->where($conn)->find();
    	$this->assign('CurrentAssessType',$CurrentAssessType);
    	

    
    	
    	$this->display();
    }
    
    public function del() {
    	$id = $_GET['id'];
    	if($id == NULL ||  is_numeric($id) == FALSE) {
    		echo "id Error.";
    		return 0;
    	}
    	$model = M("Risk");
    	$conn['id'] = $id;
    	$result = $RiskInfo = $model->where($conn)->delete();
    	if($result) {
    		$this->success('您删除了'.$result.'条数据！', U('Risk/index'));
    	} else {
    		$this->error('删除新风险项出现错误！',U('Risk/index'));
    	}
    	
    }
    
    public function add(){
    	if($_POST == NULL) {
    		#查询所有AssessType，供用户选择修改
    		$Assess = M('Assess');
    		$AssessList = $Assess->select();
    		$this->assign('AssessList', $AssessList);
    		$this->display();
    		return 0;
    	}
    	$Risk = M("Risk");
    	if($Risk->create()){
    		// 由于create方法自动转义kingeditor的html标签，需要还原
    		$Risk->riskdetail=htmlspecialchars_decode($Risk->riskdetail);
    		$Risk->test=htmlspecialchars_decode($Risk->test);
    		$Risk->scope=htmlspecialchars_decode($Risk->scope);
    		$Risk->fixes=htmlspecialchars_decode($Risk->fixes);
    		$Risk->reference=htmlspecialchars_decode($Risk->reference);
    		$result = $Risk->add(); // 写入数据到数据库 
	    	if($result){
	    		// 如果主键是自动增长型 成功后返回值就是最新插入的值
	    		$this->success('创建成功！', U('Risk/index'));
	    	} else {
	    		$this->error('创建新风险项出现错误！',U('Risk/index'));
	    	}
    	}
    }
    
    #修改AssessType方法
    public function assessEdit() {
    	$assessid = $_POST['assessid'];
    	$riskid = $_POST['riskid'];
    	
    	#数据更新，assessid没有一样会导致更新失败
    	$Assess = M('Risk');
    	$data['assessid'] = $assessid;
    	$conn['id'] = $riskid;
    	$rst = $Assess->where($conn)->save($data);

    	if($rst == FALSE) {
    		$data = array(
	    		'info' => '数据更新失败',
	    		'callback' => U('Risk/index')
    		);
    	} else {
    		$data = array(
	    		'info' => 'ok',
	    		'callback' => U('Risk/index')
    		);
    	}
    	$this->ajaxReturn($data);
    	
    }
    
    public function save(){
    	$Risk = M("Risk"); // 实例化User对象
    	// 要修改的数据对象属性赋值
    	$id = $_POST['id'];
    	if($id == NULL) {
    		echo "No record.";
    		return 0;
    	}
    	$conn['id'] = $id;
    	$Risk->class = $_POST['class'];
    	$Risk->risklevel = $_POST['risklevel'];
    	$Risk->riskname = $_POST['riskname'];
    	$Risk->riskdetail = $_POST['riskdetail'];
    	$Risk->test = $_POST['test'];
    	$Risk->scope = $_POST['scope'];
    	$Risk->fixes = $_POST['fixes'];
    	$Risk->reference = $_POST['reference'];
    	$Risk->ischeck = $_POST['ischeck'];
    	
    	
    	$rst = $Risk->where($conn)->save();
    	if($rst == FALSE) {
    		$this->error('更新出现错误！',U('Risk/index'));
    	} else {
    		$this->success('更新成功！', U('Risk/index'));
    	}
    	
    }
}