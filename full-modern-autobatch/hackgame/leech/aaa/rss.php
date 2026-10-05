<?php
define('_IN_JOHNCMS', 1);
$headmod = 'rss_read';
$rootpath = '';
require_once ('incfiles/core.php');
require_once ('incfiles/head.php');
$link = $_POST['link'];
$link = 'http://fulltextrssfeed.com/www.24h.com.vn/upload/rss/'.$link;
if($rights < 9) {
echo'Đăng nhập mới có thể Leech, chỉ có admin mới có quyền Leech';
require_once ('incfiles/end.php');
exit;
}
if(isset($_POST['submit'])) {
function DeleteHTMLTag($str){
return strip_tags($str, '<b>,<img>,<br>,<i>');
}

$content = file_get_contents($link);
$x = new SimpleXmlElement($content);
foreach($x->channel->item as $entry) {
$noidung = $entry->description;
$noidung = DeleteHTMLTag($noidung);
$check = @$connect->query("SELECT * FROM ...")$connect->query("SELECT `text` FROM `forum` WHERE `text`='".$entry->title."' AND `type` = 't'"));
$noidung = str_replace('<b>','[b]',$noidung);
$noidung = str_replace('</b>','[/b]',$noidung);
$noidung = str_replace('<br/>','[br]',$noidung);
$noidung = str_replace('<br />','[br]',$noidung);
$noidung = preg_replace('#<br>(.*?)</br>#si','[br]\1',$noidung);
$noidung = str_replace("http://pixel.quantserve.com/pixel/p-89EKCgBk8MZdE.gif","",$noidung);
$noidung = str_replace('<img src="" border="0" height="1" width="1" />','',$noidung);
$noidung = preg_replace('#<img(.*?)src="(https?:\/\/\S+\.(?:jpg|png|gif))"(.*?)/>#si', '[br]\2[br]', $noidung);
$noidung = trim($noidung);
$noidung = trim($noidung);
if(strlen($noidung) > 500 && $check ==0) {
echo '<div class="rmenu">Super Auto Leech đã leech thành công...!!! <a href="/rss.php">[Bấm vào đây Leech tiếp]</a> hoặc trở lại <a href="/index.php">[Trang Chủ]</a></div>';
$connect->query("UPDATE `users` SET `postforum`=`postforum`+1 WHERE `id`='01'");
$connect->query("UPDATE `users` SET `lastpost` = '$realtime' WHERE `id`='01'");
$connect->query("INSERT INTO `forum` SET
`refid` = '93',
`type` = 't',
`time` = '" . time() . "',
`user_id` = '01',
`from` = 'Nhox.Pro',
`text` = '$entry->title'
");
$rid = mysql_insert_id();
// Добавляем текст поста
$connect->query("INSERT INTO `forum` SET
`refid` = '$rid',
`type` = 'm',
`time` = '" . time() . "',
`user_id` = '1',
`from` = 'Nhox.Pro',
`ip` = '1.0.0.0',
`ip_via_proxy` = '12345678',
`soft` = 'Nhox.Pro',
`text` = '" . mysql_real_escape_string($noidung) . "'
");
$connect->query("UPDATE `forum` SET
`kiemduyet` = '1',
`time` = '" . time() . "',
`kiemduyet_who` = 'Hệ Thống'
WHERE `id` = '".$rid."'");
}
}
} else {
echo'<div class="phdr">Auto leech</div>' .
'<div class="menu"><font color="red">Super Auto Leech Tin Tức <img src="http://hinhanh.khung.mobi/img/yeu.png"></font>' .
'<form action="" method="post"><input type="text" name="link" value="tintuctrongngay.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="anninhhinhsu.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="bantrecuocsong.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="thoitranghitech.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="tienvangchungkhoan.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="lamdep.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="tingame.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="dienthoai.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="thethao.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="otoxemay.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="vitinhinternet.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="thitruongtieudung.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="dulich.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="cuoisuot24gio.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="phithuongkyquac.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="giaoducduhoc.rss"/>' .
'<input type="submit" name="submit" value="Leech"/></form></div>'.
'<div class="menu"><font color="red"><a href="/tin.php">Leech Tin Tức VNEXPRESS</a></font></div>' .
'<div class="menu"><font color="red"><a href="/leechpro.php">Leech Tin Tức Dân Trí</a></font></div>'.
'<div class="menu"><font color="red"><a href="/kenh14.php">Leech Tin Tức Kênh14</a></font></div>'.
'<div class="menu"><font color="red"><a href="/2sao.php">Leech Tin Tức 2Sao</a></font></div>'.
'<div class="menu"><font color="red"><a href="/muctim.php">Leech Tin Tức Mực Tím</a></font></div>'.
'<div class="menu"><font color="red"><a href="/vnn.php">Leech Tin Tức ViệtNamNet</a></font></div>';
}
require_once ('incfiles/end.php');
?>