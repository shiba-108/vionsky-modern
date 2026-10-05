<?php
define('_IN_JOHNCMS', 1);
require ('../../incfiles/core.php');
$textl = 'Tạo Chữ Kí Kute Online, Tạo Chữ Kí Kute Đẹp';
$mota = 'Tạo chữ kí đẹp và kute theo ý bạn hãy tạo cho riêng mình chữ kí thật đẹp nhé !';
require ('../../incfiles/head.php');
$text = $_GET['text'];
if(!empty($text)){
$chars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
$row1_new = array('α','в','¢','∂','є','ƒ','g','н','ι','נ','к','ℓ','м','η','σ','ρ','q','я','ѕ','т','υ','ν','ω','χ','у','z');
$row1 = str_replace($chars,$row1_new,$text);
$row2_new = array('4','8','(','d','3','f','9','h','!','j','k','1','m','n','0','p','q','r','5','7','u','v','w','x','y','2');
$row2 = str_replace($chars,$row2_new,$text);
$row3_new=array('Á','ß','Č','Ď','Ĕ','Ŧ','Ğ','Ĥ','Ĩ','Ĵ','Ķ','Ĺ','M','Ń','Ő','P','Q','Ŕ','Ś','Ť','Ú','V','Ŵ','Ж','Ŷ','Ź');
$row3 = str_replace($chars,$row3_new,$text);
$row4_new=array('ค','๒','ς','๔','є','Ŧ','ﻮ','ђ','เ','ן','к','l','๓','ภ','๏','ק','ợ','г','ร','t','ย','ש','ฬ','א','ץ','z');
$row4 = str_replace($chars,$row4_new,$text);
$row5_new=array('ä','b','ċ','d','ë','f','ġ','h','ï','j','k','l','m','n','ö','p','q','r','s','t','ü','v','w','x','ÿ','ż');
$row5 = str_replace($chars,$row5_new,$text);
$row6_new=array('á','b','ć','d','é','f','g','h','í','j','k','l','m','ń','ő','p','q','ŕ','ś','t','ú','v','w','x','ý','ź');
$row6 = str_replace($chars,$row6_new,$text);
$row7_new=array('Λ','B','ᄃ','D','Σ','F','G','Ή','I','J','K','ᄂ','M','П','Ө','P','Q','Я','Ƨ','Ƭ','Ц','V','Щ','X','Y','Z');
$row7 = str_replace($chars,$row7_new,$text);
$row8_new=array('ﾑ','乃','c','d','乇','ｷ','g','ん','ﾉ','ﾌ','ズ','ﾚ','ﾶ','刀','o','ｱ','q','尺','丂','ｲ','u','√','w','ﾒ','ﾘ','乙');
$row8 = str_replace($chars,$row8_new,$text);
$row9_new=array('ⓐ','ⓑ','©','ⓓ','ⓔ','ⓕ','ⓖ','ⓗ','ⓘ','ⓙ','ⓚ','ⓛ','ⓜ','ⓝ','ⓞ','ⓟ','ⓠ','ⓡ','ⓢ','ⓣ','ⓤ','ⓥ','ⓦ','ⓧ','ⓨ','ⓩ');
$row9 = str_replace($chars,$row9_new,$text);
}
$tit = 'Viết Chữ Kute, Chữ Kí Tự, Kí Tự Đặc Biệt';
$key = 'viet chu kute, tao chu kute, chu ki tu, ki tu dac biet, viet chu ki tu, viet chu dep, chu ki tu dep, chu hay, chu kute dep';
echo'<div class="main-xmenu"><div class="danhmuc">Tạo Chữ Kí Kute</div>
<div class="menu"><form method="get" action="">Nhập nội dung:<br/>
<input type="text" name="text" value="'.$text.'"><br/>
<input type="submit" value="Tạo chữ kí"></form></div></div>';
if(!empty($text)){
echo'<div class="main-xmenu"><div class="danhmuc">Kết Quả</div>';
echo '<div class="menu"><input type="text" value="'.$row1.'">
<br>
<input type="text" value="'.$row2.'">
<br>
<input type="text" value="'.$row3.'">
<br>
<input type="text" value="'.$row4.'">
<br>
<input type="text" value="'.$row5.'">
<br>
<input type="text" value="'.$row6.'">
<br>
<input type="text" value="'.$row7.'">
<br>
<input type="text" value="'.$row8.'">
<br>
<input type="text" value="'.$row9.'">
</div>
</div>';
}
require ('../../incfiles/end.php');
?>