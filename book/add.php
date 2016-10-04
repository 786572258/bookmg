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
		
	//debug($_POST);exit;

		$bookname = $_POST['bookname'];
		$publisher = $_POST['publisher'];
		$author = $_POST['author'];
		$price = $_POST['price'];
		
		$detail = $_POST['detail'];
		$cid = $_POST['cate'];
        $recom = $_POST['recom'] ? 'Y':'N';
        $intro = $_POST['intro'];

		if($pic = upload('pic')) {
			//echo '上传文件'.$pic.'成功';
		} else {
			exit();
		}

		$sql = "insert into books(bookname,publisher,author,price,ptime,pic,detail, cid, recom, intro) values('$bookname','$publisher','$author','$price',".time().",'$pic','$detail', '$cid', '$recom', '$intro')";
		if(mysql_query($sql) && mysql_affected_rows() > 0) {
			echo "<script>alert('添加图书成功')</script>";
		} else {
			echo "<script>alert('添加图书失败');</script>";
		}
	}

	//获取所有分类
	$cate = getAll("SELECT * FROM cate");
	//debug($cate);

    
?>
<div class="amend">
<h3>添加图书</h3>
<form action="add.php" method="post" enctype="multipart/form-data" class="demoform">
<dl>
  <dd>
   图书名称：	<input type="text" class="text" name="bookname" value="" datatype="*1-50" />
  </dd>
  <dd>
   所属分类		<select name="cate" style="  margin-left: 14px;" datatype="*">
					<option value="">请选择</option>
					<?php foreach($cate as $k=>$v){?>
					<option value="<?php echo $v['c_id']?>"><?php echo $v['c_name']; ?></option>
					<?php } ?>
				</select>
  </dd>
  <dd>
   发 布 商：		<input type="text" class="text" name="publisher" value=""  datatype="*1-50"/>
  </dd>
  <dd>
   作　　者：		<input type="text" class="text" name="author" value="" datatype="*1-20"/>
  </dd>
  <dd>
   价　　格：		<input type="text" class="text" name="price" value="" datatype="/^[0-9]+(\.[0-9]{0,2})*$/" errormsg="请填写小数点不多于两位的数字"/>
  </dd>
  <dd> 
   图　　片：		<input type="text" class="text" name="filePath" id="filePath"/>

                    <input type="file" id="txtfilePath" name="pic"  style="display:none;" datatype="*" nullmsg="请选择图片上传">

                    <input type="button" onclick="txtfilePath.click()" id="fileup" name="fileup" class="button green" value="上传" style="width:70px;">
  </dd>

  <dd>
    推　　荐：      <input type="checkbox" name="recom"  />
  </dd>

  <dd>
    <!--介　　绍：      <br /><br /><textarea name="intro"></textarea>-->

  </dd>

  <dd>
    <span style="vertical-align:20px;"> 描　　述：		</span>
	<textarea  name="detail" id="p_content" cols="30" rows="10" ></textarea>
	<script>var ue = UE.getEditor('p_content',{"focus":false});
		//var editor = new UE.ui.Editor({initialFrameHeight:100,initialFrameWidth:900 });       
		//editor.render("p_content");
	</script>
  </dd>
  <dd>
			<input type="submit" class="button green" name="dosubmit" value="添加图书" />
  </dd>
  </dl>

  <script type="text/javascript">
	$('input[type="button"]').click(function(){
	//	alert($('#p_content').text());return false;
	});
  </script>
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
