<?php 
define('_IN_JOHNCMS',1); 
require('../incfiles/core.php'); 
$textl='Tặng vật phẩm'; 
require('../incfiles/head.php'); 
function capphep(){ 
Global $user_id; 
$array=array(1,2); 
If(in_array($user_id,$array)) return true; else return false;
} 
if(!capphep()){ 
require_once($rootpath.'incfiles/head.php'); 
echo functions::display_error('Bạn không có quyền vào đây!');
require_once($rootpath.'incfiles/end.php'); 
} 
echo'<div class="phdr">Tặng vật phẩm Mod By Khoai</div>'; 
if(isset($_POST['submit'])){ 
$id=intval($_POST['id']); 
$user=intval($_POST['u']); 
$sql1=$connect->query("select `name`,`id` from `users` where `id`='$user' limit 1");
if(!$connect->query("SELECT * FROM ...")$sql1)){ 
echo'<div class="loi">Không tìm thấy vật phẩm này</div>'; 
}else{ 
$u=$connect->fetch_array($sql1); 
$login=$u['name']; 
if($connect->query("SELECT * FROM ...")$connect->query("select `id` from `kho` where `nick`='$login' and `loai`='".$_POST['loai']."' and `ten`='".$_POST['vp']."' limit 1"))){ 
echo'<div class="phdr">'.$login.' đã có vật phẩm này rồi.</div>';}else{ 
$connect->query("insert into `kho` set `nick`='$login',`loai`='".$_POST['loai']."',`ten`='".$_POST['vp']."',`imgd`='/images/".$_POST['loai']."/".$_POST['vp'].".png'")or die(mysql_error());
$text = '<b>'.nick($user_id).'</b><font color="000000"> vừa tặng cho bạn một vật phẩm hãy vào </font><a href="/avatar/tui2.php?tip='.$_POST['loai'].'"><font color="003366">Balô</font></a> để kiểm tra.'; 
$connect->query("INSERT INTO `thongbao` SET
`id` = '".$user_id."',`user` = '".$u['id']."',`text` = '$text',`ok` = '1',`time` = '" . time() . "'");
echo'<div class="thanhcong">Tặng thành công</div>'; 
}/////không có lỗi 
}//////có vật phẩm này 
} ///////submit 
echo'<form method="post"><div class="menu"><p>id thành viên: <input type="text" name="u" value="'.$_POST['u'].'"></p><p>id vật phẩm: <input type="text" name="vp" value="'.$_POST['id'].'"></p><p>Loại vật phẩm: <input type="text" name="loai" value="'.$_POST['loai'].'"></p><p align="center"><input type="submit" name="submit" value="Tặng"></form></div>'; 
require('../incfiles/end.php'); 
?>