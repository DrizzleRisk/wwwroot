<?php
namespace Home\Controller;
use Think\Controller;
class ReportController extends Controller {
    public function index() {
        echo "no hacking";
    }
    public function file() {
        $this->display();
    }
    /**
     * 查询报告
     * @access public
     * @param string $_GET['md5']
     * @return void
     */
    public function search() {
    	//通过查询查询报告
    	$md5 = I('get.md5');
    	$model = M('file');
    	$condition['md5'] = $md5;
    	$info = $model->where($condition)->find();
    	$r['msg'] = '提示信息';
    	$r['ret'] = 1;
        if($info == NULL) {
        	$r['data'] = '对不起，未找到该记录。';
    	}else if($info['status'] != 2) {
        	$r['data'] = '您的报告还未生成，请稍后再查询。';
        }else {
    		$r['ret'] = 2;
    		$r['msg'] = 'ok';
    		$r['data'] = U('Report/show?md5='.$md5);
    	}
    	$this->AjaxReturn($r);
    }
    /**
     * 审计报告输出
     * @access public
     * @param string $_GET['md5']
     * @return void
     */
    public function show() {
    	$md5 = I('get.md5');
    	$model = M('file');
    	$condition['md5'] = $md5;
    	$info = $model->where($condition)->find();
    	$savePath = $info['savepath'];
    	
    	if($info == NULL) {
    		die("No record.");
    	}
    	
    	if($info['status'] != 2) {
    		die("The Application hasn't Done. Please waiting for few minutes.");
    	}
    	

    	
    	//转换测试时间
    	$info = array_merge($info, timeConvert($info['totaltime']));  
    	$this->assign('info',$info);// 赋值数据集
    	
    	$file_id = $info['id'];
    	$risk = M('Risk');
    	$analysis = M('Analysis');
    	//查询漏洞个数
    	unset($conn);
    	$conn['fileid'] = $info['id'];
    	$conn['verdict'] = 2;
    	$riskCount = $analysis->where($conn)->count();
    	$this->assign('riskNumber',$riskCount);
    	//查询安全漏洞与风险评估结果
    	unset($conn);
    	$conn['assessid'] = 2;
    	$conn['ischeck'] = 1;
    	$vulInfo = $risk->where($conn)->order('risklevel desc')->select();
    	
    	for($i=0; $i<sizeof($vulInfo); $i++) {
    		unset($conn);
    		$conn['riskid'] = $vulInfo[$i]['id'];
    		$conn['fileid'] = $file_id;
    		$rst = $analysis->where($conn)->find();
    		if($rst != FALSE) {
    			$vulInfo[$i]['result'] = $rst['result'];
    			$vulInfo[$i]['verdict'] = $rst['verdict'];
    		} else {
    			$vulInfo[$i]['result'] = NULL;
    			$vulInfo[$i]['verdict'] = NULL;
    		}
    	}
    	$this->assign('vul',$vulInfo );
    	
    	
    	#查询Drozer安全审计结果
    	unset($conn);
    	$conn['assessid'] = 1;
    	$conn['ischeck'] = 1;
    	$riskInfo = $risk->where($conn)->order('risklevel desc')->select();
    	 
    	for($i=0; $i<sizeof($riskInfo); $i++) {
    		unset($conn);
    		$conn['riskid'] = $riskInfo[$i]['id'];
    		$conn['fileid'] = $file_id;
    		$rst = $analysis->where($conn)->find();
    		if($rst != FALSE) {
    			$riskInfo[$i]['result'] = $rst['result'];
    			$riskInfo[$i]['verdict'] = $rst['verdict'];
    		} else {
    			$riskInfo[$i]['result'] = NULL;
    			$riskInfo[$i]['verdict'] = NULL;
    		}
    	}
    	$this->assign('risk',$riskInfo );
    	
    	#查询敏感信息与权限审计结果
    	unset($conn);
    	$conn['assessid'] = 3;
    	$conn['ischeck'] = 1;
    	$tipsInfo = $risk->where($conn)->order('risklevel desc')->select();
    	
    	for($i=0; $i<sizeof($tipsInfo); $i++) {
    		unset($conn);
    		$conn['riskid'] = $tipsInfo[$i]['id'];
    		$conn['fileid'] = $file_id;
    		$rst = $analysis->where($conn)->find();
    		if($rst != FALSE) {
    			$tipsInfo[$i]['result'] = $rst['result'];
    			$tipsInfo[$i]['verdict'] = $rst['verdict'];
    		} else {
    			$tipsInfo[$i]['result'] = NULL;
    			$tipsInfo[$i]['verdict'] = NULL;
    		}
    	}
    	$this->assign('tips',$tipsInfo );
    	
    	//显示截图
    	$picPath = BASE_PATH.$savePath;
    	$picPath = dirname($picPath).'/'.$md5;
    	$picList = getDirPicture($picPath);
    	$this->assign('picture', $picList);
    	//$this->assign('empty','<span class="empty">没有数据</span>');
    	$this->display ();
    }
    public function log() {
    	$md5 = $_GET['md5'];
    	if(strpos($md5, '.') != FALSE || strpos($md5, '/')!=FALSE) {
    		echo "Error";
    		return 0;
    	}
    	if(strlen($md5) !=32) {
    		echo "no MD5";
    		return 0;
    	}
    	$outputsPath = BASE_PATH.'Uploads/App/'.$md5.'.outputs.txt';
    	
    	if(file_exists($outputsPath)) {
    		$handle = fopen($outputsPath,'r');
    		$outputs = fread($handle, filesize($outputsPath));
    		fclose($handle);
    		header("Content-type: UTF-8");
    		#$outputs = iconv("UTF-8","UTF-8",$outputs);
    		$outputs=str_replace("\n","<br>", $outputs);
    		$outputs=str_replace("E: ","<b style=\"color:red\">Error: </b>", $outputs);
    		$outputs=str_replace("S: ","<b style=\"color:green\">Success: </b>", $outputs);
    		$outputs=str_replace("W: ","<b style=\"color:orange\">Warning: </b>", $outputs);
    		$outputs=str_replace("I: ","<b style=\"color:Blue\">Info: </b>", $outputs);
    		$this->assign('outputs', $outputs);// 赋值数据集
    		$this->assign('md5', $md5);
    		$this->display ();
    	} else {
    		echo "Sorry, Reports Not Exists.";
    	}
    	return 1;
    }
}