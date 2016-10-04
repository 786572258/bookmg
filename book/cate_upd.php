<script>

</script>
<?php
	echo '<link href="../classes/Page.css" rel="stylesheet" type="text/css" />';
	include 'header.php';
?>

<div class="amend">
<form action='' method='post'>
	<input type="hidden" name="c_id" value="<?php echo $_GET['c_id']?>" />
	分类名：<input type='text' name='c_name' value="<?php echo $_GET[c_name]?>" />
	<input type='submit' name='' value='修改分类' class="button green" />
</form>
</div>


<?php
	if($_POST) {
		$c_id = $_POST['c_id'];
		$c_name = $_POST['c_name'];

		if($c_name!='') {
			$res = getAll("SELECT * FROM cate WHERE c_name='$c_name' AND c_id != '$c_id' LIMIT 1");
			if($res) {
				echo "<script>layer.msg('".$c_name."分类名已经存在',{offset: 500,shift: 6})</script>";
				return;
			}
			$sql = "UPDATE cate SET c_name='$c_name' WHERE c_id='$c_id'";
			if(mysql_query($sql) && mysql_affected_rows() > 0) {
				echo "<script>alert('修改分类成功！');</script>";
				
				echo "<script>setTimeout("."'location.href=\'./cate.php\''".", 900);</script>";
				
			} else {
				echo "<script>alert('修改分类失败');</script>";
			}
		} else {
			echo "<script>layer.msg('没有分类名',{offset: 500,shift: 6})</script>";
		}

	}
?>
<?php
	include 'footer.php';
?>