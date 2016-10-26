<script src="../js/jquery-1.9.1.min.js" ></script>
<script src="../js/layer-v1.9.1/layer/layer.js" ></script>
<style type="text/css">
	html {
		background:url(./banner.jpg);
		background: url(./banner.jpg);
		background-repeat: no-repeat;
		background-size: 100% 100%;
	}
</style>
<?php
	include '../config.inc.php';
	include '../db.inc.php';
	include '../classes/Vcode.class.php';
	header('content-type:text/html;charset=utf-8');
	session_start();
	/*$res = mysql_query("SELECT * FROM books");
	
	while($row = mysql_fetch_assoc($res)) {
		$arr[] = $row;
	}
	print_R($arr);
	*/
?>

<style>
	.login{
		/*position: absolute;
		left:500px;
		margin: 150px auto;
		width:350px;
		height:270px;
		border: 1px solid #ccc;
		background: #fff;
		*/
	}
	.login dl {
	    font-size: 14px;
	    color: #666;
	    padding: 10px 0 0 10px;
	    position: relative;
	}
	.login dl dd {
         padding: 5px 0;
    }
	.login dl dd input.text {
        width: 200px;
        height: 25px;
        border: 1px solid #ccc;
        background: #fff;
        font-size: 14px;
        color: #666;
	}
	.login h2 {
		height: 40px;
		line-height: 40px;
		text-align: center;
		font-size: 14px;
		letter-spacing: 1px;
		color: #666;
		background: url(../images/login_header.png) repeat-x;
		margin: 0 0 20px 0;
		padding: 0px;
		border-bottom: 1px solid #ccc;
		cursor: move;
	}
	.login .other {
		font-size: 13px;
		display: block;
		text-align: right;
		padding: 0 20px 10px 0;

	}
	.login a.other  {
		text-decoration: none;
		color: #333;	
	}
	.login a.other:hover {
		text-decoration: underline;
		color: #000;
	}
	.button {
	    font-size: 12px; 
	    text-decoration: none!important; 
	    font-family: Helvetica, Arial, sans serif;
	    padding: 4px 6px; 
	    border-radius: 3px; 
	    -moz-border-radius: 3px; 
	    box-shadow: inset 0px 0px 2px #fff;
	    -o-box-shadow: inset 0px 0px 2px #fff;
	    -webkit-box-shadow: inset 0px 0px 2px #fff;
	    -moz-box-shadow: inset 0px 0px 2px #fff;
	}
	.button:active {
	    box-shadow: inset 0px 0px 3px #999;
	    -o-box-shadow: inset 0px 0px 3px #999;
	    -webkit-box-shadow: inset 0px 0px 3px #999;
	    -moz-box-shadow: inset 0px 0px 3px #999;
	}


	.green {
	    color: #333;
	    border: 1px solid #95b959;
	    background-image: -moz-linear-gradient(#cae387, #a5cb5e);
	    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#a5cb5e), to(#cae387));
	    background-image: -webkit-linear-gradient(#cae387, #a5cb5e);
	    background-image: -o-linear-gradient(#cae387, #a5cb5e);
	    text-shadow: 1px 1px 1px #dff4bc;
	    background-color: #a5cb5e;
	}
	.green:hover {
	    border: 1px solid #687e30;
	    background-image: -moz-linear-gradient(#a5cb5e, #cae387);
	    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#cae387), to(#a5cb5e));
	    background-image: -webkit-linear-gradient(#a5cb5e, #cae387);
	    background-image: -o-linear-gradient(#a5cb5e, #cae387);
	    background-color: #cae387;
	}
	.green:active {border: 1px solid #506320;}

</style>


<script> 
   function fsubmit(obj){ 
   obj.submit(); 
   } 
   
   function freset(obj){ 
   obj.reset(); 
   } 
</script>

<!-- <form id="form1" name="form1" action="" method="post">
<div class="login" >
<h2>网站登陆</h2>
<dl>
	<dd>
		用户名：<input type="text" class="text" name="a_name" value=""/>
    </dd>
    <dd>
		密　码：<input type="password" class="text" name="a_pass" value=""/>
    </dd>
    <dd>
		<span style="vertical-align:7px;"> 验证码：<input type="password" class="text" name="code" value="" style="width:100px;"/></span>
		<img src="../classes/v.class.php" onclick="this.src='../classes/v.class.php?aa='+Math.random()">
    </dd>
    <dd>
		<input type="submit" style="width:100px;margin-left:70px;margin-top:10px; font-size:14px;" class="button green" value="登 陆"　/>
	</dd>

</dl>
   <a class="other" href="javascript:freset(document.form1);">重新填写</a>
</div>

</form>
 -->
      

<?php
	if($_POST) {
		$code = $_POST['code'];
		$a_name = $_POST['a_name'];
		$a_pass = $_POST['a_pass'];

		/* if($_SESSION['code']!=$code) {
			//echo "<script>alert('验证码错误')</script>";exit;
			echo '&nbsp;';
			//echo "<script>alert('')</script>";
		} */

		
			
		$res = mysql_query("SELECT * FROM admin WHERE a_name='$a_name' AND a_pass='$a_pass'");
		$row = mysql_fetch_row($res);
		if($row) {
			$_SESSION['admin'] = $a_name;

	
			alertBack('登陆成功', 'list.php');
			
		} else {
			alertBack('登陆失败', 'login.php');
		}
	}
?>



<script type="text/javascript">
function animon(){
	var div=$("#layui-layer1");

			
	div.animate({height:'500px',opacity:'0.4'},"slow");
	div.animate({width:'94%',marginLeft:'-30%',opacity:'0.8'},"slow");
	//div.animate({height:'100px',opacity:'0.4'},"slow");
	// div.animate({width:'100px',opacity:'0.8'},"slow");
	div.slideUp();

	//$(".layui-layer").slideUp();
}
$(function(){
	
	//在这里面输入任何合法的js语句
	layer.open({
		type: 1, //page层
		area: ['500px', '300px'],
		title: '你好，请登录',
		skin: '', //墨绿风格
		shade: 0.4, //遮罩透明度
		shift: -1, //0-6的动画形式，-1不开启

		content: '<form id="form1" name="form1" action="" method="post"><div class="login"><dl><dd>用户名：<input type="text" class="text" name="a_name" value=""/></dd><dd>密　码：<input type="password" class="text" name="a_pass" value=""/></dd><dd><span style="vertical-align:7px;"></dd><dd><input type="submit" style="width:100px;margin-left:70px;margin-top:10px;font-size:14px;" class="" value="登 陆"/></dd></dl></div></form>'
		///content: '<a href="#">sss</a>'
	});

	$('.layui-layer-close1').remove();




	$('input[type="button"]').click(function(){
		//加载层-风格2
		layer.msg('验证中', {icon: 16,time:1200});
		//此处演示关闭
		setTimeout(function(){
			layer.closeAll('loading');
			var code = $('input[name="code"]').val();
			var	name = $('input[name="a_name"]').val();
			var pass = $('input[name="a_pass"]').val();
			$.post("./ajax.php?act=checkLogin",{code:code,name:name,pass:pass},function(data){
				if(data==2) {
					//layer.msg('验证码错误',{shift: 6});
					layer.tips('验证码不对哦~', '#code', {
						tips: 1//还可配置颜色
					});
					//setTimeout('window.location.href=\'login.php\'',2000);
				} else if(data==3) {
					layer.msg('账号或密码错误',{shift: 6});
					
				} else if(data==1) {
					layer.msg('登录成功,跳转...', {
						offset: 0,
						shift: 2,
						icon:1
					});

					animon();
					setTimeout('location.href=\'list.php\'',2000);
					

				} else {
					layer.msg('登录失败',{shift: 6});
				}
			})
		}, 1200);
		
	})
})


		
</script>