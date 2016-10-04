<?php
    echo '<link href="../classes/Page.css" rel="stylesheet" type="text/css" />';

	include 'header.php';
	//fenlei
	
	

?>
<div class="amend">
<form action="" method="post">
<!-- <select name="c_id">
	<option value="">请选择</option>
	

</select> -->
<br />
分类名：<input type="text" name="c_name" value="" >
<input type="submit" value="添加分类" class="button green">
<form>
</div>
<?php
	if($_POST) {
		$c_name = $_POST['c_name'];
		$c_id = $_POST['c_id'];

		if($c_name!='') {
			//判断分类名是否重复
			$res = getAll("SELECT * FROM cate WHERE c_name='$c_name' LIMIT 1");
			if($res) {
				echo "<script>alert('分类名已经存在');</script>";
				return;
			}
			$sql = "INSERT INTO cate SET c_name='$c_name'";
			if(mysql_query($sql) && mysql_affected_rows() > 0) {
				//echo '<br />添加分类成功！';
				echo "<script>alert('添加分类成功！');</script>";
			} else {
				echo "<script>alert('添加分类失败');</script>";
			}
		} else {
				echo "<script>alert('请填写分类名');</script>";
		}

	}
?>
<?php
	include 'footer.php';
?>