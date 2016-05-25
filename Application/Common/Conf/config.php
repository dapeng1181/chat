<?php
return array(
	'MODULE_ALLOW_LIST'    =>    array('Manage','Client','Chat','Home'),
	'DEFAULT_MODULE'       =>    'Home',
	'URL_MODEL'          => '1',

	'OFFICIAL_WEBSITE' => 'localhost',
	//安全过滤
    'DEFAULT_FILTER' => 'strip_tags,htmlspecialchars,magicAddslashes,trim',
		//数据库连接
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '121.199.40.122',
    'DB_NAME' => 'wechat',
    'DB_USER' => 'yaojiajing',
    'DB_PWD' => 'yaojiajing',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'we_',

);