<?php
	//头utf-8
	header('content-type:text/html;charset=utf-8');
	//显示所有报告但不报告注意
	error_reporting(E_ALL & ~E_NOTICE);
	//时区
	date_default_timezone_set('PRC');

	//每页记录数
	$pageSize = 10;
	$watermark = 'watermark_cwr.png'; //放在uploads目录下
	
	
	
	/* function debug($d) {
		echo "<pre>";
		print_r($d);
	} */
	
	function mydate($time) {
		return date("Y-m-d H:i:s", $time);
	}
	
	
	function mydate2($time) {
		return date("Y-m-d", $time);
	}
	
	function alertBack($msg='', $url='') {
		if(!$url) {
			$url = "window.history.back()";
		} else {
			$url = "window.location.href='$url'";
		}
		die("<script>alert('{$msg}');{$url};</script>");
		
	}
	
?>