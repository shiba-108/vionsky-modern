<?php
define('_IN_JOHNCMS', 1);
$headmod = 'rss_read';
$rootpath = '';
require_once ('../../incfiles/core.php');
require_once ('../../incfiles/head.php');
$link = $_POST['link'];
$link = 'http://fulltextrssfeed.com/www.vnexpress.net/gl/'.$link;
if($rights < 9) {
echo'Đăng nhập mới có thể Leech, chỉ có admin mới có quyền Leech';
require_once ('../../incfiles/end.php');
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
$check = @$connect->query("SELECT * FROM ...")$connect->query("SELECT `tieude` FROM `tintuc` WHERE `tieude`='".$entry->title."'"));
$noidung = str_replace('<b>','[b]',$noidung);
$noidung = str_replace('</b>','[/b]',$noidung);
$noidung = str_replace('<br/>','[br]',$noidung);
$noidung = str_replace('<br />','[br]',$noidung);
$noidung = preg_replace('#<br>(.*?)</br>#si','[br]\1',$noidung);
$noidung = str_replace("http://pixel.quantserve.com/pixel/p-89EKCgBk8MZdE.gif","",$noidung);
$noidung = str_replace('<img src="" border="0" height="1" width="1" />','',$noidung);
$noidung = preg_replace('#<img(.*?)src="(https?:\/\/\S+\.(?:jpg|png|gif))"(.*?)/>#si', '[img]\2[/img]', $noidung);
$noidung = trim($noidung);
$noidung = trim($noidung);
if(strlen($noidung) > 500 && $check ==0) {
$connect->query("INSERT INTO `tintuc` SET
`time` = '" . time() . "',
`tieude` = '".$entry->title."',
`noidung` = '" . mysql_real_escape_string($noidung) . "'
");
}
}
} else {
echo'<div class="phdr">Auto leech</div>' .
'<div class="menu"><font color="red">Super Auto Leech Tin Tức <img src="http://hinhanh.khung.mobi/img/yeu.png"></font>' .
'<form action="" method="post"><input type="text" name="link" value="trangchu.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="xa-hoi.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="cuoi.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="ban-doc-viet.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="oto-xe-may.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="khoa-hoc.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="gia-dinh.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="the-gioi.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="kinh-doanh.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="khoanh-khac-mua-thi.rss"/><input type="submit" name="submit" value="Leech"/></form>' .
'<form action="" method="post"><input type="text" name="link" value="phapluat.rss"/>' .
'<input type="submit" name="submit" value="Leech"/></form></div>'.
'<div class="menu"><font color="red"><a href="/rss.php">Leech Tin Tức 24h.com.vn</a></font></div>' .
'<div class="menu"><font color="red"><a href="/leechpro.php">Leech Tin Tức Dân Trí</a></font></div>'.
'<div class="menu"><font color="red"><a href="/kenh14.php">Leech Tin Tức Kênh14</a></font></div>'.
'<div class="menu"><font color="red"><a href="/2sao.php">Leech Tin Tức 2Sao</a></font></div>'.
'<div class="menu"><font color="red"><a href="/muctim.php">Leech Tin Tức Mực Tím</a></font></div>'.
'<div class="menu"><font color="red"><a href="/vnn.php">Leech Tin Tức ViệtNamNet</a></font></div>';
}
require_once ('../../incfiles/end.php');
?>