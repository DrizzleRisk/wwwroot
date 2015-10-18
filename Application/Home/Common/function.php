<?php
/**
 * 邮件发送函数
 * @access public
 * @param 邮箱地址,邮件主题,邮件内容
 * @return void
 */
function sendMail($to, $title, $content) {
	 
	Vendor('PHPMailer.PHPMailerAutoload');
	$mail = new PHPMailer(); //实例化
	$mail->IsSMTP(); // 启用SMTP
	$mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
	$mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
	$mail->Username = C('MAIL_USERNAME'); //你的邮箱名
	$mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
	$mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
	$mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
	$mail->AddAddress($to,"尊敬的用户");
	$mail->WordWrap = 50; //设置每行字符长度
	$mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
	$mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
	$mail->Subject =$title; //邮件主题
	$mail->Body = $content; //邮件内容
	$mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
	return($mail->Send());
}

function checkToken($data) {
// 	if(!C('TOKEN_ON')) {
// 		dump($_SESSION);
// 		return true;
// 	}
	$token = C('TOKEN_NAME');
	if(isset($_SESSION[$token])) {
		// 当前需要令牌验证
		if(empty($_SESSION[$token])) {
			return false;
		} else {
			if(empty($data[$token]) || $_SESSION[$token] != $data[$token]) {
				return false;
			}
		}
		$_SESSION[$token] = 0;
	}
	return true;
}

function timeConvert($time) {
	/*时间转化，把秒转换为小时、分钟、秒
	 * */
	$timeArray['h'] = 0;
	$timeArray['m'] = 0;
	$timeArray['s'] = 0;
	if($time > 3600) {
		$timeArray['h'] = intval($time/3600);
	} 
	$tmp = ($time - $timeArray['h']*3600)/60;
	if($tmp >= 1) {
		$timeArray['m'] = intval($tmp);
	}
	$timeArray['s'] = $time - $timeArray['h']*3600 - $timeArray['m']*60 ;
	return $timeArray;
}
function getDirPicture($picPath) {
	//显示截图
	$dir_handle = @opendir($picPath);
	$picList = array();
	while($file = readdir($dir_handle)) {
		if($file=='.' || $file == '..') continue;
		$file_parts = explode('.',$file);
		$ext = strtolower(array_pop($file_parts));
		$title = implode('.',$file_parts);
		$title = htmlspecialchars($title);
		if($ext == 'jpg') {
			$picList[] = str_replace(BASE_PATH,'',$picPath.'/'.$file);
		}
	}
	return $picList;
}
