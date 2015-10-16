<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index1() {
		$this->display();
	}
	public function index() {
		$model = M('file');
		$count = $model->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,15);//实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
		$list = $model->order('createtime')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display ();
	}
	public function upload() {
		
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 52428800; // 设置附件上传大小50MB
		$upload->exts = array (
				'apk',
				'zip' 
		); // 设置附件上传类型
		#$upload->savePath = './Uploads/'; // 设置附件上传目录
		// 上传单个文件
		$info = $upload->uploadOne ( $_FILES ['apkFile'] );
		if (! $info) {
			// 上传错误提示错误信息
			$this->error ( $upload->getError () );
		} else {
			// 上传成功 获取上传文件信息
			$model = M('file');
			
			//检查文件MD5,如果存在就删除已上传的文件
			$con['md5'] = $info['md5'];
			$rst = $model->where($con)->find();
			if($rst) {
				$apkPath = BASE_PATH.'Uploads/'.$info ['savepath'] . $info ['savename'];
				if(file_exists($apkPath)) {
					unlink($apkPath);
					echo "Del Upload Apk File (".$apkPath.") Successfull.</br>";
				}
				$this->error ("该APK文件已经存在，请在前台查询！");
				
			} 
			
			//新的APK文件，把基本信息存入数据库中
			$data['name'] = $info['name'];
			$data['size'] = round($info['size']/1048576.0, 2);
			$data['md5'] = $info['md5'];
			$data['savepath'] = '/Uploads/'.$info ['savepath'] . $info ['savename'];
			if( $model->add($data) ) {
				$this->redirect('Index/index', array(), 0, 'goto');
			}
			
		}
	}
}