<?php
	//处理要上传图片
	function upload($filedname) {
		$up = new FileUpload();
		$up -> set('path', '../uploads');
		$return = $up -> upload($filedname);
		if ($return) {
			//echo '上传成功'.$up -> getFileName();
			//对上传成功的图片进行缩放和缩略图
			$filename = $up -> getFileName();
			$img = new Image('../uploads');
			$img -> thumb($filename, 500, 500, $qz="");
			$img -> thumb($filename, 135, 135, $qz="th_");

			//添加水印
			global $watermark;
			$img -> waterMark($filename, $watermark, 7, "");
			return $filename;
		} else {
			echo '上传失败'.$up -> getErrorMsg();
			return false;
		}
		
	}

	//删除图片
	function delimg($imgname) {
		//unlink($imgname);
	}
?>