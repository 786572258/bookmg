<?php
	echo '<link href="../classes/Page.css" rel="stylesheet" type="text/css" />';
	include 'header.php';
	//fenlei
	
	

?>


<?php
	$res = mysql_query("SELECT * FROM borrow LEFT JOIN user ON u_id=b_uid LEFT JOIN books ON b_book_id=id ORDER BY b_id DESC");
	$b = array();
	while($row = mysql_fetch_assoc($res)) {
		$b[] = $row;
	};
	//debug($b);
	if($_GET['act']=='borrow_yes') {
		
		$sql = "UPDATE borrow SET b_status='1' WHERE b_id='$_GET[b_id]'";
		if(mysql_query($sql) && mysql_affected_rows() > 0) {
			echo "<script>layer.msg('借出成功',{offset:0,time:1200},function(){location.href='borrow.php'});</script>";
		} else {
			echo "<script>layer.msg('借出失败',{shift:6});</script>";
		}
	} else if($_GET['act']=='borrow_re') {
		
		$sql = "UPDATE borrow SET b_status='0' WHERE b_id='$_GET[b_id]'";
		if(mysql_query($sql) && mysql_affected_rows() > 0) {
			echo "<script>layer.msg('已归还',{offset:0,time:1200},function(){location.href='borrow.php'});</script>";
		} else {
			echo "<script>layer.msg('操作失败',{shift:6});</script>";
		}
	}
	
?>
	<link href="../classes/Page.css" rel="stylesheet" type="text/css" />
	<center id="search">
	<table border="1">
		<tr><th>借阅人</th><th>学号</th><th>书本</th><th>借书时间</th><th></th></tr>
		<?php foreach($b as $k=>$v){?>
		<tr><td><?php echo $v['b_name']?></td><td><?php echo $v['b_No']?></td><td><?php echo $v['bookname']?></td><td><?php echo date('Y-m-d H:i:s',$v['b_date'])?></td><td><?php if($v['b_status']==0){?><span style="color:#ccc;" href="borrow.php?act=borrow_yes&b_id=<?php echo $v['b_id']?>" >已归还</span><?php } ?><?php if($v['b_status']==1) {?><a href="borrow.php?act=borrow_re&b_id=<?php echo $v['b_id']?>" onclick="return confirm('确认归还吗？')" >还书</a><?php }?></td></tr>
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