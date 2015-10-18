<?php

namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	/**
	 * 首页展示
	 * @access public
	 * @param
	 * @return void
	 */
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
	/**
	 * 审计完成后发送邮件（获取email信息）
	 * @access public
	 * @param $_POST email,__hash__,md5
	 * @return void
	 */
	public function send_email() {
		$email = I('post.email');
		$r['ret'] = 0;
		$r['msg'] = '';
		$model = M('file');
		if (!$model->autoCheckToken($_POST)){
			// 令牌验证错误
			$r['data'] = '令牌验证错误';
		} else {
			$r['data'] = '您的邮件地址是'.$email.',请注意查收邮件';
		}
		$con['md5'] = I('post.md5');
		$data['email'] = $email;
		$rst = $model->where($con)->save($data);
		if($rst == false) {
			$r['data'] = '对不起，您的数据有误。';
		}
		$this->ajaxReturn($r);
	}
	/**
	 * 报告通知邮件发送接口
	 * @access public
	 * @param $_GET id
	 * @return void
	 */
	public function sendMailApi() {
		$id = I('get.id');
		$model = M('file');
		$conn['id'] = $id;
		$info = $model->where($conn)->find();
		$r['msg'] = '提示信息';
		if($info) {
			$to = $info['email'];
			$title = 'NDST.App安全审计报告通知';
			$content = '';
			if($info['status'] != 2) {
				$r['id'] = 0;
				$r['data'] = '很抱歉，您的App安全审计出现异常，我们已经通知了管理员进行处理，请耐心等待！';
				$content = $r['data'];
				//通知管理员
				$toAdmin = C('ADMIN_MAIL');
				$errorTitle = 'NDST.异常报告.App审计失败通知';
				$errorContent = '出现异常的ID为：'.$id.'<br>请及时处理！';
				sendMail($toAdmin, $errorTitle, $errorContent);
			} else {
				$SiteUrl = 'http://'.C('SITE_DOMAIN');
				$ReportUrl = $SiteUrl.'/index.php/Home/Report/show/md5/'.$info['md5'].'.html';
				$content = '亲爱的用户：<br>';
				$content = $content.'您的App['.$info['name'].'],';
				$content = $content.'系统用时['.intval($info['totaltime']/60).'分钟]';
				$content = $content.'已经完成安全审计.<br>请点击查看<a href='.$ReportUrl.'>报告</a><br>';
			}
			//通知用户
			$rst = sendMail($to, $title, $content);
			if($rst) {
				$r['id'] = 1;
				$r['data'] = '邮件发送成功';
			} else {
				$r['id'] = 0;
				$r['data'] = '邮件发送失败';
			}
		} else {
			$r['id'] = 0;
			$r['data'] = '没有该记录';
		}
		$this->ajaxReturn($r);
	}
	/**
	 * 文件上传
	 * @access public
	 * @param $_POST __hash__; $_FILES apkFile
	 * @return void
	 */
	public function upload() {
		
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 52428800; // 设置附件上传大小50MB
		$upload->exts = array (
				'apk',
				'zip' 
		); // 设置附件上传类型
		#$upload->savePath = './Uploads/'; // 设置附件上传目录
		// 上传单个文件
		
		//令牌有问题，待解决
		if(!checkToken($_POST)) {
			//表单token验证失败
			$r['ret'] = 1;
			$r['msg'] = '上传失败';
			$r['data'] = '表单令牌失效！请刷新网页再次进行上传作业。';
			$this->ajaxReturn($r);
		}
		$info = $upload->uploadOne( $_FILES ['apkFile'] );
		if (! $info) {
			// 上传错误提示错误信息
			$r['ret'] = 1;
			$r['msg'] = '上传文件出现错误';
			$r['data'] = $upload->getError();
			$this->ajaxReturn($r);
		} else {
			// 上传成功 获取上传文件信息
			$model = M('file');
			
			//检查文件MD5,如果存在就删除已上传的文件
			$con['md5'] = $info['md5'];
			$rst = $model->where($con)->find();
			if($rst) {
				$apkPath = BASE_PATH.'Uploads/'.$info ['savepath'] . $info ['savename'];
				if(file_exists($apkPath)) {
					//如果同MD5文件存在就删除现在这个文件
					unlink($apkPath);
					$r['ret'] = 1;
					$r['msg'] = '上传提示';
					//判断分析状态
					if($rst['status'] == 2) {
						$reportUrl = U('Report/show?md5='.$rst['md5']);
						$r['data'] = '该app已经存在了,请直接查看<a href='.$reportUrl.'>审计报告</>';
					} else {
						$r['data'] = '该app已经存在了,正在进行安全分析,请稍后通过MD5('.$rst['md5'].')查询审计报告';
					}
					$this->ajaxReturn($r);
				}

			} 
			
			//新的APK文件，把基本信息存入数据库中
			$data['name'] = $info['name'];
			$data['size'] = round($info['size']/1048576.0, 2);
			if($data['size'] == 0) {
				//文件大小不足10k的情况
				$data['size'] = 0.01;
			}
			$data['md5'] = $info['md5'];
			$data['savepath'] = '/Uploads/'.$info ['savepath'] . $info ['savename'];
			if( $model->add($data) ) {
				$r['ret'] = $data['md5'];
				$r['msg'] = '上传成功';
				$r['data'] = '提交成功，预计需要30分钟左右完成安全分析';
				$this->ajaxReturn($r);
			}
			
		}
	}
}