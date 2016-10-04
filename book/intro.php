<script src="../editor/editor_all_min.js"></script>
<script src="../editor/editor_config.js"></script>

<?php
    echo '<link href="../classes/Page.css" rel="stylesheet" type="text/css" />';

	include 'header.php';
	include '../classes/FileUpload.class.php';
	include '../classes/Image.class.php';
	include '../upload.inc.php';
    
    



	//处理按钮点击的添加图书
	if ($_POST) {

        $intro = $_POST['intro'];


		$sql = "update intro SET i_data='$intro'";

		echo $sql;
		if(mysql_query($sql) && mysql_affected_rows() > 0) {
			echo "<script>layer.alert('保存成功',{icon:1,shift:3})</script>";
		} else {
			echo "<script>layer.alert('保存失败',{icon:1})</script>";
		}
	}

	$intro = getAll("SELECT * FROM intro LIMIT 1");

	//debug($intro);

?>
<div class="amend">
<h3>图书馆简介</h3>
<form action="intro.php" method="post" enctype="multipart/form-data" class="demoform">
<dl>
  <dd>
    <span style="vertical-align:20px;"> 描　　述：		</span>
	<textarea  name="intro" id="p_content" cols="30" rows="10" ><?php echo $intro[0]['i_data']?></textarea>
	<script>var ue = UE.getEditor('p_content',{"focus":false});</script>
  </dd>
  <dd>
			<input type="submit" class="button green" name="dosubmit" value="保存" />
  </dd>
  </dl>
</form>

</div>

<script type="text/javascript">
document.getElementById("txtfilePath").onchange = function() {
	document.getElementById("filePath").value = this.value;
};

$(function(){
	$(".demoform").Validform({
		tiptype:3
	});

	$.Tipmsg.r="";

})
</script>
<?php
	include 'footer.php';
?>
