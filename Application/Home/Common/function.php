<?php
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
