<?php

		$captcha="";
	    for($i=0;$i<4;$i++)
	    	$captcha.=dechex(rand(0,15));
	    session_start();
	    $_SESSION["captcha"]=$captcha;

	    $img=imagecreatetruecolor(80, 30);
		$white=imagecolorallocate($img, 255, 255, 255);
		$black=imagecolorallocate($img, 0, 0, 0);	
		imagefill($img, 0, 0, $white);
		for ($i=0; $i < 50; $i++) 
		{ 
			$color=imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
			imagefilledellipse($img, rand(1,79), rand(1,29), rand(1,8), rand(1,8), $color);
		}
		imagestring($img, rand(1,25), rand(5,50), rand(5,15), $captcha, $black);
		header("content-type:image/png");
		imagepng($img);
		imagedestroy($img);
?>