<?php
namespace Home\Controller;
use Think\Controller;
class FileViewController extends Controller {
	public function index(){	
		$md5 = I('get.md5');
		$file = I('get.file');
		$type = I('get.type');
		if(strpos($md5,'.')!==False || strpos($md5,'/')!==False || strlen($md5)!=32) {
			$this->error('参数MD5错误，请检查并修正');
		}
		if(strpos($file, '..') !== False) {
			$this->error('参数file错误，请检查并修正');
		}
		$file = str_replace('\\', '/', $file);
		$analysis_dir = BASE_PATH.'Uploads/Analysis/'.$md5.'/';
		$file_ext = substr(strrchr($file, '.'), 1);
		$tpl;
		$file_path = $analysis_dir.$file;
		
		//兼容性处理
		if(strpos($file, '/data/') !== False && strpos($file, 'DYNAMIC_DeviceData') == False) {
			$file_path = BASE_PATH.'Uploads/Analysis/'.$md5.'/DYNAMIC_DeviceData/'.$file;
		}
		if($file_ext == 'java' && strpos($file, 'java_source') == False) {
			$file_path = BASE_PATH.'Uploads/Analysis/'.$md5.'/java_source/'.$file;
		}
		if($file_ext == 'smali' && strpos($file, 'smali_source') == False) {
			$file_path = BASE_PATH.'Uploads/Analysis/'.$md5.'/smali_source/'.$file;
		}
		if(file_exists($file_path)) {
			
			if($type == 'image') {
				//直接图像输出
				header('Content-Type: image/png');
				$im = imagecreatefrompng($file_path);
				imagepng($im);

			} else if ($type == 'xml') {
				
				$handle = fopen($file_path, "r");
				$tpl['fileName'] = $file;
				$tpl['fileType'] = 'xml';
				$tpl['jsFileName'] = 'shBrushXml.js';
				$tpl['fileContent'] = fread($handle, filesize($file_path));
				fclose($handle);
				$this->assign('tpl', $tpl);
				$this->display();
			} else if ($type == 'java') {
				
				$handle = fopen($file_path, "r");
				$tpl['fileName'] = $file;
				$tpl['fileType'] = 'java';
				$tpl['jsFileName'] = 'shBrushJava.js';
				$tpl['fileContent'] = fread($handle, filesize($file_path));
				fclose($handle);
				$this->assign('tpl', $tpl);
				$this->display();
			} else if ($type == 'smali') {
				$handle = fopen($file_path, "r");
				$tpl['fileName'] = $file;
				$tpl['fileType'] = 'smali';
				$tpl['jsFileName'] = 'shBrushSmali.js';
				$tpl['fileContent'] = fread($handle, filesize($file_path));
				fclose($handle);
				$this->assign('tpl', $tpl);
				$this->display();
			} else if($type == 'txt'){
				//文本显示
				$handle = fopen($file_path, "r");
				$tpl['fileName'] = $file;
				$tpl['fileType'] = 'plain';
				$tpl['jsFileName'] = 'shBrushPlain.js';
				$tpl['fileContent'] = fread($handle, filesize($file_path));
				fclose($handle);
				$this->assign('tpl', $tpl);
				$this->display();
			} else if ($type == 'db') {
				//SQLite format 3
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment; filename=".$file); 
				readfile($file_path);
			} else {
				header("Content-Type: application/force-download");
				header("Content-Disposition: attachment; filename=".$file); 
				readfile($file_path);
			}
			
			
		} else {
			$this->error($file.'文件不存在');
		}
	}
	
}