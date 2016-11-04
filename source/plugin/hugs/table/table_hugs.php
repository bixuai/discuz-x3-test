<?php
	class table_hugs extends discuz_table{
		public function __construct(){
			parent::__construct();
		}
		public function getuser($uid){
			return DB::fetch_first('select * from pre_common_member where uid='.$uid);
		}
		// public function getcredits(){
		// 	return DB::fetch_first('select credits from %t limit 1',array('common_member'));
		// }
		public function insertcredits($array){
			return DB::insert('home_nutsdetail',$array,true);
		}
		public function insertdonum($array){
			return DB::insert('home_nuts',$array);
		}
		public function updatedonum($array,$where){
			return DB::update('home_nuts',$array,$where);
		}
		public function getdonum($uid){
			return DB::fetch_first('select * from pre_home_nuts where uid='.$uid);
		}
		public function getnuts($uid){
			return DB::fetch_all('select nuts from pre_home_nutsdetail where uid='.$uid);
		}
	}
