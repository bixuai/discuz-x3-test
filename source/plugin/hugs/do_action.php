<?php

	// loadcache('plugin');
	// global $_G;
	define('APPTYPEID', 0);
	// define('CURSCRIPT', 'member');

	require '../../class/class_core.php';
	$discuz = C::app();
	$discuz->init();
	//获取当前用户id
	$uid = $_G['uid'];
	//判断是读取数据还是需要更新数据
	if($_GET['nuts']){
		//声明相应数组
		$arr_nuts = array('1'=>'笔记本',2=>'洗衣机',3=>'电冰箱',4=>'篮球',5=>'谢谢参与',6=>'足球',7=>'护腕',8=>'手环',9=>'闹钟');
		//获取对应奖品名
		$nuts = $arr_nuts[$_GET['nuts']];
		//将要插入奖品记录表的数据放入输入数组中
		$arr = array();
		$arr['nuts'] = $nuts;
		$arr['uid'] =$uid;
		//插入数据
		$insertid = C::t('#hugs#hugs')->insertcredits($arr);
		$donum = C::t('#hugs#hugs')->getdonum($uid);
		
		//操作抽奖数据表
		if(!empty($donum)){
			if($insertid){
				//插入数据成功
				$donum['donum'] +=1;
				C::t('#hugs#hugs')->updatedonum($donum,'uid ='.$uid);
			}
		}else{
			//没有抽过奖的插入初始数据
			C::t('#hugs#hugs')->insertdonum(array('uid'=>$uid,'donum'=>'1'));
		}

		//读取可用积分数，以及抽奖记录
		$resu = array();
		//获取所有奖品
		$nuts = C::t('#hugs#hugs')->getnuts($_G['uid']);
		$resu['nuts'] = $nuts;
		// var_dump($nuts);

		$user = C::t('#hugs#hugs')->getuser($_G['uid']);
		$credits = $user['credits'];
		//计算可用抽奖积分
		$donum = C::t('#hugs#hugs')->getdonum($_G['uid']);
		// echo $credits.$donum;
		$usecredits = $credits - $donum['donum']*3;
 		// C::t('#hugs#hugs')->insert();
		$resu['usecredits'] = $usecredits;
		// var_dump($resu);
		echo json_encode($resu);
	}else{//初始化显示可用抽奖积分以及抽奖记录
		$resu = array();
		//获取所有奖品
		$nuts = C::t('#hugs#hugs')->getnuts($_G['uid']);
		$resu['nuts'] = $nuts;
		// var_dump($nuts);
		$user = C::t('#hugs#hugs')->getuser($_G['uid']);
		$credits = $user['credits'];
		//计算可用抽奖积分
		$donum = C::t('#hugs#hugs')->getdonum($_G['uid']);
		// echo $credits.$donum;
		$usecredits = $credits - $donum['donum']*3;
 		// C::t('#hugs#hugs')->insert();
		$resu['usecredits'] = $usecredits;
		// var_dump($resu);
		echo json_encode($resu);
	}
		