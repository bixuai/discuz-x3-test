<?php  
    if(!defined('IN_DISCUZ')) {  
        exit('Access Denied');  
    }  
      
      
    //各种安装操作  
    $sql = "show tables";  
    runquery($sql);  
    //或  
    DB::query($sql);  
      
     $sql = "create table nuts(
		id int(11) primary key auto_increment not null,
		name varchar(10) not null

     	)engine=myisam;charset=utf8";
	runquery($sql);
      
    $finish = TRUE;  
      
?>  