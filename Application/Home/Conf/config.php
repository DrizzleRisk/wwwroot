<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'	=> 'mysql',
	'DB_HOST'	=> 'localhost', 
	'DB_NAME'	=> 'apksec',
	'DB_USER'	=> 'root',
	'DB_PWD'	=> '',
	'DB_PORT'	=> '3306',
	'DB_CHARSET'	=> 'utf8',

	// 配置邮件发送服务器
    'MAIL_HOST'	=>	'smtp.163.com',//smtp服务器的名称
    'MAIL_SMTPAUTH'	=>	TRUE, //启用smtp认证
    'MAIL_USERNAME'	=>	'NetDragonST@163.com',//你的邮箱名
    'MAIL_FROM'	=>	'NetDragonST@163.com',//发件人地址
    'MAIL_FROMNAME'	=>	'NDST',//发件人姓名
    'MAIL_PASSWORD'	=>	'xkcxiwvmnhynfhxh',//邮箱密码
    'MAIL_CHARSET'	=>	'utf-8',//设置邮件编码
    'MAIL_ISHTML'	=>	TRUE, // 是否HTML格式邮件
    
	//网站配置
	'SITE_DOMAIN'	=>	'apk.nsaadp.com:8088',
	'ADMIN_MAIL'	=>	'382106212@qq.com',
	'DEFAULT_THEME'	=>	'tencent',
);