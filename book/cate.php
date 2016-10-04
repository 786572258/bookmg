<?php
	echo '<link href="../classes/Page.css" rel="stylesheet" type="text/css" />';
	include 'header.php';
	//fenlei
	
	

?>


<?php
	$res = mysql_query("SELECT * FROM cate");
	$cate = array();
	while($row = mysql_fetch_assoc($res)) {
		$cate[] = $row;
	};
	
	if($_GET['act']=='del') {
		$sql = "DELETE FROM cate WHERE c_id='$_GET[c_id]'";
		if(mysql_query($sql) && mysql_affected_rows() > 0) {
			echo "<script>alert('删除成功'); location.href='cate.php'</script>";
			//echo "<script>layer.msg('删除成功',{offset:0,time:1200},function(){location.href='cate.php'});</script>";
		} else {
			echo "<script>alert('删除失败');</script>";
		}
	}
	
?>
	<link href="../classes/Page.css" rel="stylesheet" type="text/css" />
	<center id="search">
	<table border="1">
		<tr><th>分类id</th><th>分类名</th><th>操作</th></tr>
		<?php foreach($cate as $k=>$v){?>
		<tr><td><?php echo $v['c_id']?></td><td><?php echo $v['c_name']?></td><td><a href="cate_upd.php?act=upd&c_id=<?php echo $v['c_id']?>&c_name=<?php echo $v['c_name']?>" >修改</a>&nbsp;&nbsp;<a href="?act=del&c_id=<?echo $v['c_id']?>" onClick="return confirm('确定删除吗？')">删除</a></td></tr>
		<?php }?>
	</table>
	</center>

<script>
	function confirm_del(cid) {
		layer.confirm('确定删除该分类吗', {
			btn: ['是滴','表要'], //按钮
			shade: false //不显示遮罩
		}, function(){
			location.href="?act=del&c_id="+cid;
			//return true;
		}, function(){
			layer.msg('不要要算了', {shift: 6});
		});

		return false;
	}
</script>
<?php
	include 'footer.php';
?>