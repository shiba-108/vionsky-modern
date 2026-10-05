<?php
function watermark($image, $text, $save){
$font = 'arialbd.ttf';
$compress = '100'; //chất lượng nén ảnh, tính bằng %
$gocquay= '0';//goc quay
$size = '18'; // Cỡ chữ
$tcolor = '666666';//màu chữ dạng hex

$a = imagettfbbox($size, $gocquay, $font, $text);
$width = abs($a[1]) + abs($a[2]);//chiều rộng text
$height = abs($a[5])+abs($a[0]);//chiều cao text

$info = getimagesize($image);
$mime = $info[mime];
$h = $info[1];
$w = $info[0];
if($w>=$width+4){

if($mime=='image/png'){
$im = imagecreatefrompng($image);
}
elseif($mime=='image/jpeg'){
$im = imagecreatefromjpeg($image);
}
elseif($mime=='image/gif'){
$im = imagecreatefromgif($image);
}
$new_h = $h+$height+9;//chiều cao của hình ảnh mới

$new_im= imagecreatetruecolor($w, $new_h); //tạo ảnh mới
$white = imagecolorallocate($new_im, 235, 235, 235);
imagefill($new_im, 0, 0, $white); //tô màu trắng
imagecolortransparent($new_im, $white);

$text_color = imagecolorallocate($new_im, 153, 153, 153);

imagettftext($new_im, $size, $gocquay, $w-$width-7, $h+abs($a[5]-3), $text_color, $font, $text);//in text lên ảnh mới

imagealphablending($new_im,false);
imagesavealpha($new_im,true);

imagecopy ($new_im, $im, 0, 0, 0, 0, $w, $h); //copy ảnh cần đóng dấu vào ảnh mới

if($mime=='image/png'){
imagepng($new_im, $save);
}
elseif($mime=='image/jpeg'){
imagejpeg($new_im, $save, $compress);
}
elseif($mime=='image/gif'){
imagegif($new_im, $save);
}

}else{
copy($image,$save);}

}//endfunc
?>