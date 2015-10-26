<?php

namespace Home\Controller;
use Think\Controller;
class FileController extends Controller {
	public function index() {
		$md5 = I('get.md5');
		$this->assign('md5', $md5);
		$this->display();
	}
	public function show() {
		$md5 = I('get.md5');
		$model = M('file');
    	$condition['md5'] = $md5;
    	$info = $model->where($condition)->find();
    	if($info) {
	    	$savePath = $info['savepath'];
			$analysisFile = BASE_PATH.$savePath;
	    	$analysisPath = dirname($analysisFile).'/'.$md5;
			$file = I('post.file');
			$filePath = $analysisPath.$file;
			$filePath = str_replace('../','',$filePath);
			$ext = end(explode('.', $filePath));
			$readArray = array('java','smali','json','yml','txt','xml','c', 'html', 'js', 'css', '');
			if(in_array($ext, $readArray)) {
				$data['ret'] = 2;
				$f = fopen($filePath,"r");
				$data['data'] = fread($f,filesize($filePath));
				fclose($f);
				$this->ajaxReturn($data);
			} else {
				$data['ret'] = 1;
				$data['data'] = str_replace(BASE_PATH,'', $analysisPath).$file;
				$this->ajaxReturn($data);
			}

    	} else {
    		die('No record.');
    	}

	}
	public function connect() {
		//重要，定义一个常量，在插件的PHP入口文件中验证，防止非法访问。
		define("IN_ADMIN",1);
		//对路径进行安全检查
		if(filter_dir(I('post.dir')) == false) {
			$this->redirect('File/index/md5/'.I('get.md5'));
		}
		$root = $_SERVER['DOCUMENT_ROOT'];
		$md5 = I('get.md5');
    	$model = M('file');
    	$condition['md5'] = $md5;
    	$info = $model->where($condition)->find();
    	$root = '';
    	if($info) {
	    	$savePath = $info['savepath'];
			$analysisFile = BASE_PATH.$savePath;
	    	$analysisPath = dirname($analysisFile).'/'.$md5;
			$root = $analysisPath;
    	} else {
    		die('No record.');
    	}
    	include('./Public/jqueryfiletree/dist/connectors/jqueryFileTree.php');
        
	}
}