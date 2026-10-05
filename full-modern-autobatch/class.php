<?php
define('_IN_JOHNCMS', 1);
$rootpath = ''; 
require('incfiles/core.php');
$phpbb_root_path = '';
function khd($str) {
$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
$str = preg_replace('/(đ)/', 'd', $str);
$str = preg_replace('/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $str);
$str = preg_replace('/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/', 'E', $str);
$str = preg_replace('/(Ì|Í|Ị|Ỉ|Ĩ)/', 'I', $str);
$str = preg_replace('/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/', 'O', $str);
$str = preg_replace('/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/', 'U', $str);
$str = preg_replace('/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/', 'Y', $str);
$str = preg_replace('/(Đ)/', 'D', $str);
//$str = str_replace(' ', '-', str_replace('&*#39;','",$str));
return $str;
}


	use PHPImageWorkshop\ImageWorkshop;
	require_once($phpbb_root_path.'PHPImageWorkshop/ImageWorkshop.php');
if($_GET['u']){
$u = preg_replace("/[^0-9]/","",$_GET['u']);
$exp = mysqli_result($connect->query('SELECT level FROM users WHERE id='.$u),0,'level');
} else {
$u = $user->data['id'];
$exp=$user->data['level'];
}
$data = $connect->query('SELECT c.class AS class, c.level AS level, c.exp AS cexp, n.exp AS nextexp FROM class c LEFT JOIN class n ON (n.level=c.level+1) WHERE '.(($exp==0)?'c.exp = 0':'c.exp <= '.$exp).' ORDER BY c.exp DESC LIMIT 1');
$level = mysqli_result($data,0,'level');
$class = mysqli_result($data,0,'class');
$currentexp=mysqli_result($data,0,'cexp');
$nextexp=mysqli_result($data,0,'nextexp');
$classimg = ImageWorkshop::initFromPath('class/KR_class_'.$level.'.png');
$image = ImageWorkshop::initVirginLayer(85, 33);
$image->addLayerOnTop($classimg, 0, 7, "LB");
$current = floor(($exp-$currentexp)/($nextexp-$currentexp)*100);
$start = isset($_GET['s']) ? $_GET['s'] : 0;
$end = isset($_GET['e']) ? $_GET['e'] : 100;
$p = isset($_GET['p']) ? $_GET['p'] : 0;
 
$pos = floor($current/($end - $start) * 60);
 
$im = imagecreate(60, 5); // width , height px
$white = imagecolorallocate($im, 0, 0, 0);
$black = imagecolorallocate($im, 0, 0, 0);
$green = imagecolorallocate($im, 0, 204, 51);
 
imagesetthickness($im, 2);
 
imagerectangle($im, 0, 0, 60, 4, $white);
imagefilledrectangle($im, 0, 0, $pos, 5, $green);
 
if ($p) {
	$text = ($pos / 2) . '%';
	$font = 'arial.ttf';
	$black = imagecolorallocate($im, 0, 0, 0);
	imagettftext($im, 8, 0, 95, 12, $black, $font, $text);
}
$bar = ImageWorkshop::initFromResourceVar($im);
$image->addLayerOnTop($bar, 24, 8, "LB");
$text = "Cap ".(($level<100) ? "".$level.", ".$current."%" : "MAX")."
EXP: ".$exp;
$fontPath = "font/pixel1.TTF";
$fontSize = 6;
$fontColor = "000000";
$textRotation = 0;
$backgroundColor = ""; // optionnal
$text = ImageWorkshop::initTextLayer($text, $fontPath, $fontSize, $fontColor, $textRotation, $backgroundColor);
$image->addLayerOnTop($text, 24, 14, "LB");
if($class){
$text = khd($class);
$fontPath = "font/pixel1.TTF";
$fontSize = 6;
$fontColor = "000000";
$textRotation = 0;
$backgroundColor = ""; // optionnal
$text = ImageWorkshop::initTextLayer($text, $fontPath, $fontSize, $fontColor, $textRotation, $backgroundColor);
$image->addLayerOnTop($text, 0, 0, "LB");
}

$image = $image->getResult();
header('Content-type: image/png');
header('Content-Disposition: filename="class.png"');
header("Cache-Control: no-cache, must-revalidate");
imagepng($image, null, 8);
exit;
?>