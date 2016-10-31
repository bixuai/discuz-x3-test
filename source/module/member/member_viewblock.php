<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: class_zip.php 27449 2012-02-01 05:32:35Z zhangguosheng $
 */



define('API_GETINFO', 1);//设置获取信息开关
if(!API_GETINFO) {
	exit('Access Denied');
}


// define('APPTYPEID', 0);
// define('CURSCRIPT', 'member');

// require './class_core.php';

// $discuz = C::app();
// //返回$_app   discuz_application对象

// $modarray = array('activate', 'emailverify', 'getpasswd',
// 	'groupexpiry', 'logging', 'lostpasswd',
// 	'register', 'regverify', 'switchstatus','viewblock');
// //声明操作类型数组
// $discuz->var['mod'] = 'viewblock';
// $mod = !in_array($discuz->var['mod'], $modarray) && (!preg_match('/^\w+$/', $discuz->var['mod']) || !file_exists(DISCUZ_ROOT.'./source/module/member/member_'.$discuz->var['mod'].'.php')) ? 'register' : $discuz->var['mod'];

// define('CURMODULE', $mod);//当前的动作变量

// $discuz->init();//初始化整个discuz应用，数据库，session操作初始化


interface igetInfo 
{
	//获取板块的版主信息
	//获取板块的名字
	//获取板块的基本图片
	//获取板块的帖子数量
	public function getInfos();
	

}

class getInfo implements igetInfo
{
	public function getInfos()
	{
		// $query = DB::query("SELECT tid,subject FROM ".DB::table('forum_thread')." WHERE displayorder >=0 order by dateline desc limit 10");
		// // echo DB::table('forum_thread');
		// while($thread = DB::fetch($query)) {
		
		// echo '<a href="forum.php?mod=viewthread&tid='.$thread[tid].'" target="_blank">'.$thread[subject].'</a><br>';

		// }
		//pre_forum_forum  name posts 帖子数 forum=1 pre_forum_forumfield fid=forum.fid moderators  pre_forum_forum_threadtable 
		$query = DB::query("select m.name,d.moderators,m.posts from pre_forum_forum as m,pre_forum_forumfield as d where m.fup=1 and m.fid=d.fid");
		//定义接受查询结果数组
		$row = array();
		//遍历出所有查询到的结果
		while($result = DB::fetch($query)){
			$row[] = $result;
		}
		//输出查询的结果
		return $row;
	}
}
//实例化对象
$info = new getInfo;
//调用方法
$message = $info->getInfos();
foreach ($message as $key => $value) {
	echo '板块名:&nbsp;&nbsp;'.$value['name'].'&nbsp;&nbsp;板主:&nbsp;&nbsp;'.$value['moderators'].'帖子数量:&nbsp;&nbsp;'.$value['posts'].'<hr/>';
}
?>