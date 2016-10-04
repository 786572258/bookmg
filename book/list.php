<?php
	include 'header.php';
	include '../classes/Page.class.php';
echo "<script>var none1=false; </script>";
	//处理单个删除
	if (isset($_GET['action']) && $_GET['action'] == 'del') {
		//对磁盘的文件（图片）进行删除
		//通过id到数据库中查找要删的图片的路径
		$sql = 'select pic from books where id='.$_GET['id'];
		if (($res = mysql_query($sql)) != '') {
			$pic = mysql_fetch_row($res);
			@unlink('../uploads/'.$pic[0]);
			@unlink('../uploads/th_'.$pic[0]);
		}

		//对数据库的记录也进行删除
		$sql = 'delete from books where id='.$_GET['id'];
		if (mysql_query($sql) && mysql_affected_rows() > 0) {
			//echo '删除成功';
			echo '<script type="text/javascript">alert("删除成功")</script>';
		} else {
			echo '<script type="text/javascript">alert("删除失败")</script>';
		}

	//处理多个删除
	} else if (isset($_POST['dosubmit']) && isset($_POST['id'])) {

		//对磁盘的文件（图片）进行删除
		//通过id到数据库中查找要删的图片的路径
		$sql = 'select pic from books where id in('.implode(',', $_POST['id']).')';
		//echo $sql;
		if (($res = mysql_query($sql)) != '') {
			while ($pic = mysql_fetch_row($res)) {
				@unlink('../uploads/'.$pic[0]);
				@unlink('../uploads/th_'.$pic[0]);
			}
		}

		//对数据库的记录也进行删除
		//$sql = 'delete from books where id in(1,3,4) ';
		$sql = "delete from books where id in(".implode(',', $_POST['id']).")";
		if (mysql_query($sql) && mysql_affected_rows() > 0) {
			echo '<script type="text/javascript">alert("批量删除成功")</script>';
		} else {
			echo '<script type="text/javascript">alert("批量删除失败")</script>';

		}
	}


	/*处理搜索*/
	$where = "";
	if ($_GET['act'] == 'ser') {
		// echo '进来了';
		// var_dump($_POST);
		// echo '来到了查询';
		//因为有分页的get传参数或搜索按钮的post来处理分页与查询
		$tmp = $_REQUEST;
		$arr = array();
		$args = "";
		if (!empty($tmp['bookname'])) {
			//echo 'jinlai';
			$bookname = $tmp['bookname'];
			$arr[] = 'bookname like \'%'.$bookname.'%\' ';
			$args .= '&bookname='.$tmp['bookname'];
		}
		if (!empty($tmp['author'])) {
			$author = $tmp['author'];
			$arr[] = "author like '%{$tmp['author']}%' ";
			$args .= '&author='.$tmp['author'];
		}
		if (!empty($tmp['minprice'])) {
			$minprice = $tmp['minprice'];
			$arr[] = "price >= ".$tmp['minprice'];
			$args .= '&minprice='.$tmp['minprice'];
		}
		if (!empty($tmp['maxprice'])) {
			$maxprice = $tmp['maxprice'];
			$arr[] = "price <= ".$tmp['maxprice'];
			$args .= '&maxprice='.$tmp['maxprice'];
		}

		
		//echo '<br>'.$args.'</br>';
		//print_r($arr);
		if (empty($arr)) {
			$where = "";
		}else {
			//echo 'dfdfdfdf';
			$where = " and ".implode(' and ', $arr);
			//echo $where;
		}
		
	} elseif($_GET['act'] == 'borrowBook') {
		$time = time();
		$b = mysql_query("INSERT INTO borrow SET b_status=1, b_No='$_POST[b_No]', b_name='$_POST[b_name]', b_date='$time', b_book_id='$_GET[id]'");
		if($b) {
			alertBack("借出成功");
		} else {
			alertBack("借出失败");
		}
	}


	//实例化分页类
	//获取总记录数
	$sql = 'select count(*) from books WHERE 1=1 '.$where.' ';
	$res = mysql_query($sql);
	//debug($res);
	if($res) {
		$count = mysql_fetch_row($res);
	 
		if($count[0]) {
			
		} else {
			$count=0;
			echo "<script>layer.msg('木有所查图书',{offset:500,shift:6}); none1=true;</script>";

		}
	} else {
		echo "<script>layer.msg('木有所查图书',{offset:500,shift:6}); none1=true;</script>";

	}
	//print_r($count);exit();
	//echo 'args--------';
	//print_r($args);
	$page = new Page($count[0], $pageSize, $args);


	//获取列表数据
	$sql = 'select id, bookname, publisher, author, price, ptime, pic, detail from books WHERE 1=1 '.$where.' ORDER BY id DESC '.' '.$page->limit;
	//echo 'sql语句：'.$sql;
	
	$res = mysql_query($sql);

	

	echo '<link href="../classes/Page.css" rel="stylesheet" type="text/css" />';
	/*图书搜索*/

	echo '<center id="search">';
	echo '<h4>搜索图书</h4>';

	echo '<form action="list.php?act=ser" method="post">';
	echo '按书名：<input type="text" name="bookname" value="'.$bookname.'" size=8 />&nbsp;&nbsp;';
	echo '按作者：<input type="text" name="author" value="'.$author.'" size=8 />&nbsp;&nbsp;';
	echo '按价格：<input type="text" name="minprice" value="'.$minprice.'" size=8 />-';
	echo '<input type="text" name="maxprice" value="'.$maxprice.'" size=8 />&nbsp;&nbsp;';
	echo '<input type="submit" name="sersubmit" class="button green" size=8 />&nbsp;&nbsp;';
	echo '</form>';
    echo '</center>'; 
    
    
    //echo '<center><h3>图书列表</h3></center>';
		echo '<div id="photosDemo" class="photos-demo">';
	echo '<form action="list.php?page='.$page->page.'" method="post" onsubmit="return confirm(\'是否删除所选项\')">';
	echo '<table align="center" cellpadding="0" cellspacing="0" >';
	

	//表头
	echo '<tbody>';
	echo '<tr>';
	echo '<th width="1%">'.'多选'.'</th>';
	echo '<th width="3%">'.'编号'.'</th>';
	echo '<th width="5%">'.'图书名称'.'</th>';
	echo '<th width="5%">'.'发布商'.'</th>';
	echo '<th width="5%">'.'作者'.'</th>';
	echo '<th width="5%">'.'价格'.'</th>';
	echo '<th width="5%">'.'发布日期'.'</th>';
	echo '<th width="5%">'.'图片'.'</th>';
	echo '<th width="13%">'.'描述'.'</th>';
	echo '<th width="5%">'.'操作'.'</th>';
	echo '</tr>';
    echo '</tbody>';
	//内容
	
	while (list($id, $bookname, $publisher, $author, $price, $ptime, $pic, $detail) = @mysql_fetch_row($res)) {
		
		if(!get_magic_quotes_gpc()) { 
			$detail = addslashes($detail); 

		} 
		echo '<tr id="book-'.$id.'" book-name="'.$bookname.'">';
		echo '<td><input type="checkbox" name="id[]" value="'.$id.'" /></td>';
		echo '<td>'.$id.'&nbsp;'.'</td>';
		echo '<td>《'.$bookname.'》&nbsp;'.'</td>';
		echo '<td>'.$publisher.'&nbsp;'.'</td>';
		echo '<td>'.$author.'&nbsp;'.'</td>';
		echo '<td>￥'.$price.'&nbsp;'.'</td>';
		echo '<td>'.date('Y-m-d H:i', $ptime).'&nbsp;'.'</td>';
		echo '<td align="center" class="photosDemo">'.'<img width="100" layer-src="../uploads/'.$pic.'" src="../uploads/th_'.$pic.'"/>'.''.'</td>';
		
		echo '<td>'.mb_substr($detail, 0, 20, 'utf-8').'...'.'&nbsp;'.'</td>';
		echo '<td class="td-operate"><a href="upd.php?action=upd&id='.$id.'"><span><img src="../images/pencil.png" title="编辑"/></span></a>&nbsp;<a style="margin-left: -6px;" onclick="return confirm(\'确认删除《'.$bookname.'》吗？\')" href="list.php?action=del'.$args.'&id='.$id.'&page='.$page->page.'"><span><img width="19" style="width:19px;" src="../images/cross.png" title="删除"/><a style="margin-right: -4px;margin-top: 10px;line-height: 1px; margin-left:-2px" href="javascript:;" onclick="borrowBook('.$id.')">借出</a></span></a></td>';
		
		echo '</tr>';



	}
	echo '<tfoot>';
	echo '<tr>';
	echo '<td><input type="submit" name="dosubmit" class="button green delMore" value="删除多个" ></td>';
	echo '<td colspan="9" align="right">'.$page->fpage().'</td>';
	echo '</tr>';
	echo '</tfoot>';
	echo '</table>';
	echo '</form>';
	echo '</div>';
?>


</div>
<style type="text/css">
	.td-operate a{display:block; float:left;margin-right: 7px}
	.td-operate a img{width:21px;}
</style>
<script>

function borrowBook(id) {
	var bookname = $('#book-'+id).attr('book-name');
	//alert(bookname);
	layer.open({
		type: 1, //page层
		area: ['500px', '300px'],
		title: '填写借阅人信息',
		skin: '', //墨绿风格
		shade: 0.4, //遮罩透明度
		shift: -1, //0-6的动画形式，-1不开启

		content: '<form id="form1" name="form1" action="?act=borrowBook&id='+id+'" method="post"><div class="login"><dl><dd style="font-size:16px;">借出图书：<<'+bookname+ '>></dd><br><dd>姓&nbsp;名：<input type="text" class="text" name="b_name" value="" required="required" /></dd><dd>学生号：<input type="text" class="text" name="b_No" value="" required="required"/></dd><dd><span style="vertical-align:7px;"></dd><dd><input type="submit" style="width:100px;margin-left:70px;margin-top:10px;font-size:14px;" class="" value="确定借出"/></dd></dl></div></form>'
		///content: '<a href="#">sss</a>'
	});
	
}	
	
;!function(){

	if(none1==true)
		$('.delMore').fadeOut();
	layer.config({
		extend: 'extend/layer.ext.js'
	});       
		
}();

layer.ready(function(){ 
   
    //layer.msg('欢迎使用layer');
    
    //使用相册
    layer.photos({
        photos: '.photosDemo'
    });
});

</script>
<?php
	include 'footer.php';
?>