<?php
	include '../config.inc.php';
	include '../db.inc.php';

	switch($_GET['act']) {
		case 'checkLogin':
			checkLogin();
			break;
		case 'sd':
			ssd();
			break;
	}
	function checkLogin(){
		$code = $_POST['code'];
		$a_name = $_POST['name'];
		$a_pass = $_POST['pass'];


		session_start();
		if($_SESSION['code']!=$code) {
			echo '2';
			exit;
		}

		$res = mysql_query("SELECT * FROM admin WHERE a_name='$a_name' AND a_pass='$a_pass'");
		$row = mysql_fetch_row($res);
		if($row) {
			$_SESSION['admin'] = $a_name;
			echo 1;exit;
			//echo "<script>window.location.href='./list.php'</script>";
			
		} else {
			echo 3;
		}

		$sql = "SELECT * FROM admin";
		print_r(getAll($sql));
	}
?>