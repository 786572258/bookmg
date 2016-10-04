<?php
	$im=imagecreatetruecolor(90,30);
	//调色
	$white=imagecolorallocate($im,255,255,255);
	$checkcode="";
	for($i=1;$i<=4;$i++){
		$checkcode.=dechex(rand(0,15));
	}

	imagestring($im,rand(3,5),rand(0,80),rand(0,10),$checkcode,$white);
	
	//画出干扰线
	for($i=0;$i<10;$i++){
		imageline($im,rand(0,110),rand(0,30),rand(0,110),rand(0,30),imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255)));
	}

	//session
	session_start();

	$_SESSION['code'] = $checkcode;
	header("content-type:image/png");
	imagepng($im);
?>