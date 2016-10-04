<?php
	include '../config.inc.php';
	include '../db.inc.php';
	header('content-type:text/html;charset=utf-8');
	session_start();
?>


<style>
	.login{
		margin: 100px auto;
		/* background: red; */
		width:400px;
		height:500px;
	}

	table{
		border:1px solid #abcdef;
		/* width:200px; */
		  height: 200px;

	}
</style>
<p><a href="./list.php">回首页</a></p>
<form action="" method="post">
<div class="login" >
<table>
	<tr>
		<td>用户名</td>
		<td><input type="text" name="a_name" value="<?php echo $_SESSION['admin']?>" readonly disabled/></td>
	</tr>

	<tr>
		<td>旧密码</td>
		<td><input type="password" name="oldpass" value=""/></td>
	</tr>
	<tr>
		<td>新密码</td>
		<td><input type="password" name="newpass" value=""/></td>
	</tr>

	<tr>
		<td>确认密码</td>
		<td><input type="password" name="newpass2" value=""/></td>
	</tr>

	<tr style=" text-align:center;">
		<td colspan="50"><input type="submit" value="修改"/>&nbsp&nbsp<input type="reset" value="重新填写"></td>
		<td></td>
	</tr>

	
</table>
</div>

</form>


<?php
	if($_POST) {
		$a_name = $_SESSION['admin'];
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$newpass2 = $_POST['newpass2'];

		$res = mysql_query("SELECT * FROM admin WHERE a_name='$a_name' AND a_pass='$oldpass'");
		$row = mysql_fetch_row($res);
		if($row) {
			$sql = "UPDATE admin SET a_pass='$newpass' WHERE a_name='$a_name'";
			
			
			if (mysql_query($sql) && mysql_affected_rows() > 0 ) {
				echo '<script type="text/javascript">alert("修改密码成功")</script>';
			} else {
				echo '<script type="text/javascript">alert("修改密码失败")</script>';
			}
		} else {
			echo '<script type="text/javascript">alert("旧密码错误")</script>';
		}
	}
?>