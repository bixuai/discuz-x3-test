<?php
	class plugin_hugs {
		function __construct(){

		}

		function avatar(){
			global $_G;
			$_G['hookavatar'] = 'aa';
		}
	    // function global_footer(){  
     //    	return '<script>alert("插件我来了")</script>';  
    	// } 

   		function deletemember(){

   		} 	
   		function global_cpnav_top(){
   			return "i am top";
   		}

   		function spacecp_credit_extra(){
   			return "抽奖";
   		}



	}


	class plugin_hugs_home{
		function spacecp_credit_extra(){
			// $user = C::t('#hugs#hugs')->getuser();
			// $user = C::t('#hugs#hugs')->getcredits();
			// return '积分总数'.$credits['credits'];die;
			// $insertId = C::t('')->insert($_GET[]);
			return <<<EOF
			<div style="width:200px;height:200px;text-align:center;line-height:50px;" class="score">
			
					<div class="one opt" value="1" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">笔记本</div>
					<div class="two opt" value="2" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">洗衣机</div>
					<div class="three opt" value="3" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">电冰箱</div>
				
				
					<div class="four opt" value="4" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">篮球</div>
					<div class="five opt" value="5" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">谢谢参与</div>
					<div class="six opt" value="6" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">足球</div>					
				
					<div class="seven opt" value="7" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">护腕</div>
					<div class="eight opt" value="8" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">手环</div>
					<div class="nine opt" value="9" style="width:50px;height:50px;border:1px solid blue;float:left;margin:5px;">闹钟</div>
			</div>
				<button id="ex" style="margin-left:20px;">立即抽奖</button>
				<button id="st" style="margin-left:20px;">停&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;止</button><br/>
			可用抽奖积分：<div class='use_get'>0</div><br>
			所获奖品列表：<div class='goods_list'>1</div>
			
			<script type="text/javascript" src="./static/js/mobile/jquery-1.8.3.min.js"></script>
			<script type="text/javascript">
			

			//查询出现有积分以及抽奖记录


			$.ajax({
            type: "get",
            async: false,
            url: "./source/plugin/hugs/do_action.php",
            data: "{}",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            cache: false,
            success: function (data) {
               $('.use_get').text(data['usecredits']);
               	//当积分少于3时禁止抽奖
				// alert($('.use_get').val());
				if(data['usecredits']<3){
					//设置两个按钮失效	
					$('#ex').attr('disabled',true);
					$('#st').attr('disabled',true);
					// $('#ex').click(function(){
							// return false;
					// });
				}else{
					$('#ex').attr('disabled',false);
					$('#st').attr('disabled',false);
				}
				var list = '';
				for(var x in data['nuts']){
					for(var y in data['nuts'][x])
						list = list+'['+data['nuts'][x][y]+']';
				}			
				$('.goods_list').text(list);
            },
            error: function (err) {
                alert(err);
            }
        });
			// $.get('./source/plugin/hugs/do_action.php',{},function(data){
			// 	$('.use_get').text(data['usecredits']);
			// 	var list = '';
			// 	for(var x in data['nuts']){
			// 		for(var y in data['nuts'][x])
			// 			list = list+'['+data['nuts'][x][y]+']';
			// 	}			
			// 	$('.goods_list').text(list);
			// },'json');

			
				var obj = document.getElementById('ex');
				var st = document.getElementById('st');
				//
				var into = false;
				//设置开始单击事件
				obj.onclick = function(){
					if(!into){
						into = setInterval(function(){
							var rand = Math.floor(Math.random()*9)+1;
							 // alert(rand);
							var opt = document.getElementsByClassName('opt');
							// console.log(opt);
							for(var i=0;i<opt.length;i++){
								if(opt[i].value == rand)
								console.log(opt[i].value);
								opt[rand-1].style.background = "red"; 
								if(opt[i].value != rand)
								opt[i].style.background = "white"; 							
							}
						},30)
					}
				}
				//设置停止
				st.onclick = function()
				{
					//判断哪个被选中，将选中的信息添加到表中
					var opts = $('.opt');
							// console.log(opt);
							for(var i=0;i<opts.length;i++){
								if((opts[i].style.background).indexOf("red") !=-1){
									var goodsnum = i+1;
								// alert(goodsnum);
								}
								// alert(opts[i].style.background.color);

							}
							
							$.get('./source/plugin/hugs/do_action.php',{'nuts':goodsnum},function(data){
								if(data['usecredits']<3){
									//设置两个按钮失效	
									$('#ex').attr('disabled',true);
									$('#st').attr('disabled',true);
									// $('#ex').click(function(){
											// return false;
									// });
								}else{
									$('#ex').attr('disabled',false);
									$('#st').attr('disabled',false);
								}
								//显示可用积分值
								$('.use_get').text(data['usecredits']);
								var list = '';
								for(var x in data['nuts']){

									for(var y in data['nuts'][x])
									list = list+'['+data['nuts'][x][y]+']';
								}
								
								$('.goods_list').text(list);
							},'json');
					
					clearInterval(into);
					into = false;
				}


			</script>
EOF;
			
		}
	




		// //显示积分跟奖品的钩子
		// function spacecp_credit_extra1(){
		// 	// // $totalcredits
		// 	// global $_G;
		// 	// //获取用户的总积分
		// 	// $user = C::t('#hugs#hugs')->getuser($_G['uid']);
		// 	// $credits = $user['credits'];
		// 	// //计算可用抽奖积分
		// 	// $donum = C::t('#hugs#hugs')->getdonum($_G['uid']);
		// 	// // echo $credits.$donum;
		// 	// $usecredits = $credits - $donum['donum']*3;

		// 	// return "可用抽奖积分：<div id='use_get'>".$usecredits."</div>所获奖品列表：<div id='goods_list'>1</div>";
		// }
		// function spacecp_credit_ext(){
		// 	return "22222";
		// 	return "所获奖品列表：<div id='goods_list'>1</div>";
		// }
	}
	class plugin_hugs_forum{
		function forumdisplay_top(){
			return "222222";
		}

		function viewthread_abc() {
			return "<a>33333</a>";
		}

		function index_output(){
			return "abc";
		}
		function viewthread_abc_output(){
			return "abc";
		}
		function viewthread_abc_message(){
			return "message";
		}
		function forumdisplay_top_output(){
			return "forumdisplay_top";
		}
		function mod_output(){
			
		}
	}