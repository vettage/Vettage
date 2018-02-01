<?php


/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
/*
$imgUrl = '/home/harlan/git/vettage/www/media/uploads/stories/max-big.jpg';
// original sizes
$imgInitW = 1679;
$imgInitH = 502;
// resized sizes
$imgW = 501.6932270916335;
$imgH =150;
// offsets
$imgY1 = 0;
$imgX1 = 150;
// crop box
$cropW = 150;
$cropH = 200;
// rotation angle
$angle = 0;

/*
[imgUrl] => /media/uploads/stories/max-big.jpg
[imgInitW] => 1679
[imgInitH] => 502
[imgW] => 501.6932270916335
[imgH] => 150
[imgY1] => 0
[imgX1] => 150
[cropH] => 150
[cropW] => 200
[rotation] => 0
*/


session_start();

if (isset($_POST['imgUrl'])) {
	
	if (strstr($_POST['imgUrl'],'http://vettage/')) $_POST['imgUrl']= str_replace('http://vettage/','',$_POST['imgUrl']);
	if (strstr($_POST['imgUrl'],'http://beta.vettage.com/')) $_POST['imgUrl']= str_replace('http://beta.vettage.com/','',$_POST['imgUrl']);
	if (strstr($_POST['imgUrl'],'http://vettage.harlangroup.org/')) $_POST['imgUrl']= str_replace('http://vettage.harlangroup.org/','',$_POST['imgUrl']);
	
	
}

$imgUrl = '/home/harlan/git/vettage/www'.$_POST['imgUrl'];
// original sizes
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
// resized sizes
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
// offsets
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
// crop box
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];
// rotation angle
$angle = $_POST['rotation'];

$jpeg_quality = 100;

$my_rand = rand();
$output_filename = "/home/harlan/git/vettage/www/media/uploads/stories/".$my_rand;
$return_filename = "/media/uploads/stories/".$my_rand;

// uncomment line below to save the cropped image in the same location as the original image.
//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

$what = getimagesize($imgUrl);
switch(strtolower($what['mime']))
{
	
	case 'image/png':
        $img_r = imagecreatefrompng($imgUrl);
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.png';
        break;
    case 'image/jpeg':
        $img_r = imagecreatefromjpeg($imgUrl);
		$source_image = imagecreatefromjpeg($imgUrl);
		$type = '.jpeg';
        break;
    case 'image/gif':
        $img_r = imagecreatefromgif($imgUrl);
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.gif';
        break;
    default: die('image type not supported');
}



//Check write Access to Directory
if(!is_writable(dirname($output_filename))){
	$response = Array(
	    "status" => 'error',
	    "message" => 'Cant write cropped File'
    );	
}else{

    // resize the original image to size of editor
    $resizedImage = imagecreatetruecolor($imgW, $imgH);
	imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
    // rotate the rezized image
    $rotated_image = imagerotate($resizedImage, -$angle, 0);
    // find new width & height of rotated image
    $rotated_width = imagesx($rotated_image);
    $rotated_height = imagesy($rotated_image);
    // diff between rotated & original sizes
    $dx = $rotated_width - $imgW;
    $dy = $rotated_height - $imgH;
    // crop rotated image to fit into original rezized rectangle
	$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
	imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
	imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
	// crop image into selected area
	$final_image = imagecreatetruecolor($cropW, $cropH);
	imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
	imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
	// finally output png image
	//imagepng($final_image, $output_filename.$type, $png_quality);
	imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
	$response = Array(
	    "status" => 'success',
	    "url" => $return_filename.$type
    );
}
print json_encode($response);
exit();