<script src="../editor/editor_all_min.js"></script>
<script src="../editor/editor_config.js"></script>
<?php
	include 'header.php';
	include '../classes/FileUpload.class.php';
	include '../classes/Image.class.php';
	include '../upload.inc.php';


	//list传过来的id又进行了一次数据库连接。。。。。。不好效率不高的
	if (isset($_GET['id']) && $_GET['action'] == 'upd') {
		$sql = 'select id, bookname, publisher, author, price, pic, detail,cid, recom from books where id='.$_GET['id'];
		if ($res = mysql_query($sql)) {
			list($id, $bookname, $publisher, $author, $price, $pic, $detail, $cid, $recom) = mysql_fetch_row($res);
			
		} else {
			//echo '没有对应的图书..'.mysql_error();
			echo "<script>layer.alert('没有对应的图书',icon:3);</script>";
		}

		//获取所有分类
		$cate = getAll("SELECT * FROM cate");
	}


	//处理本页按钮点击的修改图书
	if (isset($_POST['dosubmit'])) {
		$id = $_POST['id'];
		
		//print_r($_POST);
		$bookname = $_POST['bookname'];
		$publisher = $_POST['publisher'];
		$author = $_POST['author'];
		$price = $_POST['price'];
		$srcimg = $_POST['srcimg'];
		$pic = $_POST['srcimg'];
		$detail = $_POST['detail'];
		$cid = $_POST['cate'];
		$recom = $_POST['recom']?'Y':'N';
		
		//判断用户是否有更换图片的动作
		if ($_FILES['pic']['error'] == 0) {
			//图片已上传了
			$pic = upload('pic');
			if ($pic) {
				//删除原来旧的图片
				@unlink('../uploads/'.$srcimg);
				@unlink('../uploads/th_'.$srcimg);	
			}
			$sql  = "update books set bookname='$bookname',publisher='$publisher',author='$author',price='$price',pic='$pic',detail='$detail', recom='$recom' where id=".$id;
			
		} else {
			$sql  = "update books set bookname='$bookname',publisher='$publisher',author='$author',price='$price',detail='$detail', recom='$recom' where id=".$id;

		}
		

		//echo $sql.'----------------------';
		if (mysql_query($sql) && mysql_affected_rows() > 0 ) {
			echo "<script>alert('修改成功!');location.href='?action=upd&id=$id'</script>";

			//echo "<script>layer.msg('修改成功！',{offset:500,shift: 4},function(){location.href='?action=upd&id=$id'});</script>";

		} else {
			if (mysql_affected_rows() == 0) {
				echo "<script>alert('数据没有改变!');location.href='?action=upd&id=$id'</script>";
				//echo "<script>layer.msg('数据没有改变！',{offset:500,shift: 1},function(){location.href='?action=upd&id=$id'});</script>";
			} else {
				echo "<script>alert('修改失败');location.href='?action=upd&id=$id'</script>";
				//echo "<script>layer.msg('修改失败',{offset:500,shift: 5},function(){location.href='?action=upd&id=$id'});</script>";
			}
		}
	}

    echo '<link href="../classes/Page.css" rel="stylesheet" type="text/css" />';
?>
<div class="amend">
<h3>修改图书</h3>
<form action="upd.php" method="post" enctype="multipart/form-data" class="demoform">
<dl>
 <dd>
    图书名称：	<input type="text" class="text" name="bookname" value="<?php echo $bookname; ?>"  datatype="*1-50" /> 
 </dd>
 <dd>
    所属分类	<select name="cate" style="  margin-left: 14px;" datatype="*">
					<option value="">请选择</option>
					<?php foreach($cate as $k=>$v){?>
					<option value="<?php echo $v['c_id']?>" <?php echo $v['c_id']==$cid ? 'selected' : '' ?>><?php echo $v['c_name']; ?></option>
					<?php } ?>
				</select>
 </dd>
 <dd>
    发 布 商：		<input type="text" class="text" name="publisher" value="<?php echo $publisher; ?>" datatype="*1-50"/>
 </dd>
 <dd>
    作　　者：		<input type="text" class="text" name="author" value="<?php echo $author; ?>" datatype="*1-20"/>
 </dd>
 <dd>
    价　　格：		<input type="text" class="text" name="price" value="<?php echo $price; ?>" datatype="/^[0-9]+(\.[0-9]{0,2})*$/" errormsg="请填写小数点不多于两位的数字"/>
 </dd>

　<dd>
    <img width="100" src="<?php echo "../uploads/th_".$pic; ?>" />
  </dd>
  <dd>
    <input type="hidden" name="srcimg"  value="<?php echo $pic ?>">
  </dd>
  <dd>
    图　　片：		<!--<input type="file" name="pic"   value="<?php echo $pic; ?>" /> -->

                   <input type="text" class="text" name="filePath" id="filePath"/>

                   <input type="file" id="txtfilePath" name="pic"  style="display:none;" value="<?php echo $pic; ?>" >

                   <input type="button" onclick="txtfilePath.click()" id="fileup" name="fileup" class="button green" value="上传">
                   
  </dd>
  <dd>
    推　　荐：          <input type="checkbox" name="recom" <?php if($recom=='Y') echo 'checked'?>/>
  </dd>
  <dd>
    <span style="vertical-align:20px; "> 描　　述： </span>
	 <textarea  name="detail" id="p_content" cols="30" rows="10" ><?php echo $detail; ?></textarea>
	<script>var ue = UE.getEditor('p_content',{"focus":false});</script>
  </dd>
  <dd>
    <input type="hidden"  name="id" value="<?php echo $id; ?>"/>
  </dd>
  <dd>
	<input type="submit" class="button green" name="dosubmit" value="确认修改" />
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