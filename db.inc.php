<?php
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$db = 'tushuguanli';
	$link = mysql_connect($host, $user, $pass) or die('db连接失败');
	mysql_select_db($db) or die('选择数据库失败');
	mysql_query("set names utf8");
	//mysql_query('');

	function getAll($sql) {
		$res = mysql_query($sql);
		while($row = mysql_fetch_assoc($res)) {
			$list[] = $row;
		};

		return $list;

	}

?>