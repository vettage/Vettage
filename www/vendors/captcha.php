<?
class captcha
{
  function check()
  {
	$_SESSION['captchaCode'] = $this->session->set_userdata(array('captchaCode')); //$this->session->userdata('captchaCode');
    if($_SESSION['captchaCode']== '') return false;
    $captcha = isset($_REQUEST["captcha"]) ? $_REQUEST["captcha"] : '';
    $captcha_session = isset($_SESSION["captchaCode"]) ? $_SESSION["captchaCode"] : '';

    $_SESSION['captchaCode'] = '';

    if( strtolower($captcha)==strtolower($captcha_session) )
      return true; // captcha code ok

    return false;
  }

	function generateCode($characters){
		$possible = '0123456789';
		$code = '';
   		 for( $i=0; $i<$characters; $i++ )
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
		$this->session->set_userdata(array('captchaCode'=>$code)) ;
		return $code;
	}
  
  function showImage($width=130, $height=30, $characters = 4){
    
	$code = Captcha::generateCode($characters); 
	$im = imagecreate($width, $height) or die ("Cannot initialize new GD image stream!");
    $bg = imagecolorallocate($im, 255, 255, 255);
	$color = imagecolorallocate($im, 0, 0, 0);

    for( $i=0; $i<=128; $i++ ){
     imagesetpixel($im, rand(2,$width), rand(2,$height), $color);
    }
	
    for( $i=0; $i<=1; $i++ ){
     imageline($im, rand(2, $width), rand(2, $height), rand(2, $width), rand(2, $height), $color);
    }
	
	$font ='vendors/ariblk_0.ttf';
    $text = '';
    for( $i=0; $i<$characters; $i++ ){
      $x = 5 + $i * 40;
      $y = rand(1, 6);
      //imagechar($im, 30, $x, $y, $code[$i], $color);
	  $text .= $code[$i].' ';
	
    }
	
	  imagettftext($im, 20, 0, 11, 21, $color, $font, $text);
	/* ob_end_clean() it is important for set header : prashant */
	ob_end_clean();
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if( function_exists("imagepng") ){
//	exit;

	  header("Content-type: image/png");
	  imagepng($im);
	}elseif( function_exists("imagegif") ){
      header("Content-type: image/gif");
      imagegif($im);
    }elseif( function_exists("imagejpeg") ){
      header("Content-type: image/jpeg");
      imagejpeg($im);
    }else die("No image support in this PHP server!");
	
    imagedestroy ($im);
		 $_SESSION['captchaCode'] = $code;
  }
    
}

?>