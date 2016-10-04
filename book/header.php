<?
		
	function isThisPath($str) {
		$path = pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);
		
		if($path==$str) {
			return true;
		}
	}
	
?>
<!DOCTYPE html>
<script src="../js/jquery-1.9.1.min.js" ></script>
<script src="../js/layer-v1.9.1/layer/layer.js" ></script>
<!-- <script src="../js/layer-v1.9.1/layer/extend/layer.ext.js" ></script> -->

<script type="text/javascript" src="../js/validform/js/Validform_v5.3.2.js"></script>
<script>


	$(function(){
		//layer.alert('sdfsdfsdf');
	})
</script>
<?php
	function debug($arr){
		echo '<pre style="color:red">';
		print_r($arr);
		echo '</pre>';
	}

	 include '../config.inc.php';
	 include '../db.inc.php';
      
    

	 //判断是否登陆
	 session_start();
	 if(!$_SESSION['admin']) {
		echo "<script>alert('您还未登陆！');location.href='login.php'</script>";
	 }
?>
<!doctype html>
<html>
	<head>
		<title>图书管理模块</title>
	</head>

	<body>
	<div class="tushu-background"></div>
	<div id="header">
		<!--<div class="logo"> <img src="../images/logo.gif" alt=""></div>-->
		<div class="logo"><span>图书管理</span></div>
	  <div class="login"><?php if($_SESSION['admin']) {?>欢迎：<a href="./chpwd.php"><?PHP echo $_SESSION['admin'];?></a>&nbsp;&nbsp;<a href="logout.php" onclick="return confirm('确定退出吗?')">安全退出</a><?php }?></div>
	</div>

	<div id="center">
		<div id="main">
		<!--<img src="tsgl.png" width="241px" height="70px"/>-->
        <ul>
		   <li><a href="add.php" <? if(isThisPath('add.php')){?>class="heightline"<?}?>>添加图书</a></li>
		   <li><a href="list.php" <? if(isThisPath('list.php')){?>class="heightline"<?}?>>图书列表</a></li>
		   <li><a href="cate.php" <? if(isThisPath('cate.php')){?>class="heightline"<?}?>>分类列表</a></li>
		   <li><a href="cate_add.php" <? if(isThisPath('cate_add.php')){?>class="heightline"<?}?>>添加分类</a></li>
		   <li><a href="borrow.php" <? if(isThisPath('borrow.php')){?>class="heightline"<?}?>>借阅列表</a></li>
		   <li><a href="intro.php" <? if(isThisPath('intro.php')){?>class="heightline"<?}?>>图书馆简介</a></li>
		</ul>

		</div>
        <!--<div id= "img">
		<img src="../book/banner.jpg" width="900px"/>
        </div>
		-->
		</div>
