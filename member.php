<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: member.php 34253 2013-11-25 03:36:23Z nemohou $
 */

define('APPTYPEID', 0);
define('CURSCRIPT', 'member');

require './source/class/class_core.php';

$discuz = C::app();
//返回$_app   discuz_application对象

$modarray = array('activate', 'emailverify', 'getpasswd',
	'groupexpiry', 'logging', 'lostpasswd',
	'register', 'regverify', 'switchstatus','viewblock');
//声明操作类型数组

$mod = !in_array($discuz->var['mod'], $modarray) && (!preg_match('/^\w+$/', $discuz->var['mod']) || !file_exists(DISCUZ_ROOT.'./source/module/member/member_'.$discuz->var['mod'].'.php')) ? 'register' : $discuz->var['mod'];

define('CURMODULE', $mod);//当前的动作变量

$discuz->init();//初始化整个discuz应用，数据库，session操作初始化
if($mod == 'register' && $discuz->var['mod'] != $_G['setting']['regname']) {
	showmessage('undefined_action');
}


require libfile('function/member');
require libfile('class/member');//加载制定路径文件 source/class/class_member;
runhooks();


require DISCUZ_ROOT.'./source/module/member/member_'.$mod.'.php';

?>